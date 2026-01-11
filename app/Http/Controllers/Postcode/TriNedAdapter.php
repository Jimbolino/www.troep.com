<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class TriNedAdapter extends BaseAdapter
{
    public const URL = 'https://bestel.trined.nl/';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $url = self::URL.implode('/', array_filter([$this->postcode, $this->houseNumber, $this->extension]));

        return $this->getAsync($url)->then(static fn (\Psr\Http\Message\ResponseInterface $response) => [
            'url' => $url,
            'html' => $response->getBody()->getContents(),
        ]);
    }

    public function getName(): string
    {
        return 'trined';
    }
}
