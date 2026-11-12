<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Cache\CacheManager;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Response;
use Throwable;

/**
 * Serves tha-music.htm with NPO's aac 256kbps streams filled in.
 *
 * NPO only hands those out as signed HLS links that expire 24 hours after they are made, so the
 * page marks each channel with <!--npo:slug--> and the marker becomes a fresh link here. When NPO
 * fails the marker stays an invisible comment and the rest of the row still works.
 */
final class ThaMusicController extends Controller
{
    private const FILE = __DIR__.'/../../../resources/static/tha-music.htm';
    private const MARKER = '~(</a>)?<!--npo:([a-z0-9-]+)-->~';
    private const CACHE_KEY = 'tha-music-npo-256:';
    private const GRAPHQL = 'https://api.nporadio.nl/graphql';
    private const STREAM_LINK = 'https://prod.npoplayer.nl/stream-link';
    private const BITRATE = 256000;
    // the links last 24 hours and the page is cached for 1 hour, so every link shown has 17+ hours left
    private const CACHE_TTL = 6 * 60 * 60;
    private const RETRY_TTL = 10 * 60;
    private const TIMEOUT = 5;

    public function __construct(private readonly CacheManager $cache, private readonly Factory $http)
    {
    }

    public function show(): Response
    {
        $html = (string) file_get_contents(self::FILE);
        preg_match_all(self::MARKER, $html, $matches);
        $links = $this->links(array_values(array_unique($matches[2])));

        $html = (string) preg_replace_callback(self::MARKER, static function (array $match) use ($links): string {
            $url = $links[$match[2]] ?? null;
            if (null === $url) {
                return $match[0];
            }
            $link = '<a href="'.htmlspecialchars($url).'" target="_blank">aac 256kbps (HLS)</a>';

            return '' === $match[1] ? $link : $match[1].' &middot; '.$link;
        }, $html);

        return new Response($html, 200, ['Content-Type' => 'text/html; charset=UTF-8']);
    }

    /**
     * The variant playlist with this bitrate, resolved against the master playlist's URL.
     */
    public static function variant(string $masterUrl, string $playlist, int $bitrate): ?string
    {
        [$path, $query] = explode('?', $masterUrl, 2) + [1 => ''];
        foreach (explode("\n", $playlist) as $line) {
            $line = trim($line);
            if ('' === $line || str_starts_with($line, '#') || !str_ends_with($line, '='.$bitrate.'.m3u8')) {
                continue;
            }
            $url = substr($path, 0, (int) strrpos($path, '/') + 1).$line;

            // Akamai signs the master in its query (hdnts) and usually the variants in their path (hdntl)
            return '' !== $query && !str_contains($line, 'hdntl=') ? $url.'?'.$query : $url;
        }

        return null;
    }

    /**
     * @param list<string> $slugs
     *
     * @return array<string, string> slug => signed 256 kbps playlist
     */
    private function links(array $slugs): array
    {
        if ([] === $slugs) {
            return [];
        }
        $key = self::CACHE_KEY.implode(',', $slugs);
        $links = $this->cache->get($key);
        if (\is_array($links)) {
            return $links;
        }

        try {
            $links = $this->fetch($slugs);
        } catch (Throwable $e) {
            logger()->warning('tha-music: no NPO links: '.$e->getMessage());
            $links = [];
        }
        $this->cache->put($key, $links, \count($links) === \count($slugs) ? self::CACHE_TTL : self::RETRY_TTL);

        return $links;
    }

    /**
     * Does what NPO's mini-player does: channel → player token → stream link → master playlist.
     *
     * @param list<string> $slugs
     *
     * @return array<string, string>
     */
    private function fetch(array $slugs): array
    {
        $response = $this->http->timeout(self::TIMEOUT)->post(self::GRAPHQL, [
            'query' => 'query { core_channels { data { slug live_audio { token_url } } } }',
        ]);
        $channels = $response instanceof ClientResponse ? $response->throw()->json('data.core_channels.data') : null;

        $tokenUrls = [];
        foreach (\is_array($channels) ? $channels : [] as $channel) {
            $slug = $channel['slug'] ?? null;
            $url = $channel['live_audio']['token_url'] ?? null;
            if (\in_array($slug, $slugs, true) && \is_string($url)) {
                $tokenUrls[$slug] = $url;
            }
        }

        $tokens = [];
        foreach ($this->pool($tokenUrls, static fn (PendingRequest $request, string $url) => $request->get($url)) as $slug => $response) {
            $token = $response->json('playerToken');
            if (\is_string($token)) {
                $tokens[$slug] = $token;
            }
        }

        $masters = [];
        $streamLink = static fn (PendingRequest $request, string $token) => $request
            ->withHeaders(['Authorization' => $token])
            ->post(self::STREAM_LINK, ['profileName' => 'hls', 'drmType' => ''])
        ;
        foreach ($this->pool($tokens, $streamLink) as $slug => $response) {
            $url = $response->json('stream.streamURL');
            // the FunX city and theme stations get their Icecast mp3 here
            if (\is_string($url) && str_ends_with((string) parse_url($url, \PHP_URL_PATH), '.m3u8')) {
                $masters[$slug] = $url;
            }
        }

        $links = [];
        foreach ($this->pool($masters, static fn (PendingRequest $request, string $url) => $request->get($url)) as $slug => $response) {
            $link = self::variant($masters[$slug], $response->body(), self::BITRATE);
            if (null !== $link) {
                $links[$slug] = $link;
            }
        }

        return $links;
    }

    /**
     * Runs one request per slug in parallel and keeps the successful responses.
     *
     * @param array<string, string>                   $inputs
     * @param callable(PendingRequest, string): mixed $send
     *
     * @return array<string, ClientResponse>
     */
    private function pool(array $inputs, callable $send): array
    {
        if ([] === $inputs) {
            return [];
        }
        $responses = $this->http->pool(static function (Pool $pool) use ($inputs, $send): array {
            $requests = [];
            foreach ($inputs as $slug => $input) {
                $requests[] = $send($pool->as($slug)->timeout(self::TIMEOUT), $input);
            }

            return $requests;
        });

        $successful = [];
        foreach ($responses as $slug => $response) {
            if ($response instanceof ClientResponse && $response->successful()) {
                $successful[(string) $slug] = $response;
            }
        }

        return $successful;
    }
}
