<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Controllers\ThaMusicController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

final class ThaMusicTest extends TestCase
{
    private const MASTER = <<<'M3U8'
        #EXTM3U
        #EXT-X-STREAM-INF:BANDWIDTH=143000,CODECS="mp4a.40.2"
        hdntl=exp=1~hmac=ab/x-audio_dut=128000.m3u8
        #EXT-X-STREAM-INF:BANDWIDTH=285000,CODECS="mp4a.40.2"
        hdntl=exp=1~hmac=ab/x-audio_dut=256000.m3u8
        M3U8;

    public function testFillsInSignedLinks(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'api.nporadio.nl/graphql' => Http::response(['data' => ['core_channels' => ['data' => [
                ['slug' => 'npo-radio-2', 'live_audio' => ['token_url' => 'https://play-api.nporadio.nl/play/radio2']],
                ['slug' => 'npo-funx-utrecht', 'live_audio' => ['token_url' => 'https://play-api.nporadio.nl/play/utrecht']],
                ['slug' => 'npo-luister', 'live_audio' => null],
            ]]]]),
            'play-api.nporadio.nl/play/*' => static fn (Request $request) => Http::response(['playerToken' => basename($request->url())]),
            'prod.npoplayer.nl/stream-link' => static fn (Request $request) => Http::response(['stream' => ['streamURL' => 'radio2' === $request->header('Authorization')[0]
                ? 'https://radio.ak.md.npox.nl/L1/a/b.isml/index.m3u8?hdnts=exp=1~hmac=cd'
                : 'https://icecast.omroep.nl/funx-utrecht-bb-mp3', ]]),
            'radio.ak.md.npox.nl/*' => Http::response(self::MASTER),
        ]);

        $response = $this->get('/tha-music.htm');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $response->assertSee('aac+ 32kbps</a> &middot; <a href="https://radio.ak.md.npox.nl/L1/a/b.isml/hdntl=exp=1~hmac=ab/x-audio_dut=256000.m3u8" target="_blank">aac 256kbps (HLS)</a></td>', false);
        $response->assertDontSee('<!--npo:npo-radio-2-->', false);
        // channels NPO gave no HLS stream for keep their invisible marker
        $response->assertSee('<!--npo:npo-radio-1-->', false);
        self::assertSame(1, substr_count((string) $response->getContent(), 'aac 256kbps (HLS)'));
    }

    public function testPageStillWorksWhenNpoIsDown(): void
    {
        Http::preventStrayRequests();
        Http::fake(['*' => Http::response('', 500)]);

        $response = $this->get('/tha-music.htm');

        $response->assertStatus(200);
        $response->assertDontSee('aac 256kbps (HLS)');
        $response->assertSee('<a href="https://icecast.omroep.nl/radio2-bb-mp3" target="_blank">mp3 192kbps</a>', false);
        $response->assertSee('<!--npo:npo-radio-2-->', false);
    }

    public function testVariant(): void
    {
        // Akamai: master signed in its query, variant lines carry their own token in the path
        self::assertSame(
            'https://radio.ak.md.npox.nl/L1/a/b.isml/hdntl=exp=1~hmac=ab/x-audio_dut=256000.m3u8',
            ThaMusicController::variant('https://radio.ak.md.npox.nl/L1/a/b.isml/index.m3u8?hdnts=exp=1~hmac=cd', self::MASTER, 256000),
        );
        // Akamai with plain variant lines: the master's token goes along
        self::assertSame(
            'https://radio.ak.md.npox.nl/L1/a/b.isml/b-audio_dut=256000.m3u8?hdnts=exp=1',
            ThaMusicController::variant('https://radio.ak.md.npox.nl/L1/a/b.isml/index.m3u8?hdnts=exp=1', "#EXTM3U\nb-audio_dut=256000.m3u8\n", 256000),
        );
        // the other CDN signs in the path
        self::assertSame(
            'https://radio.ft.md.npox.nl/TOKEN/L1/a/b.isml/b-audio_dut=256000.m3u8',
            ThaMusicController::variant('https://radio.ft.md.npox.nl/TOKEN/L1/a/b.isml/index.m3u8', "#EXTM3U\r\nb-audio_dut=128000.m3u8\r\nb-audio_dut=256000.m3u8\r\n", 256000),
        );
        self::assertNull(ThaMusicController::variant('https://x/index.m3u8', self::MASTER, 320000));
    }
}
