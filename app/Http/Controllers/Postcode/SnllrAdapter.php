<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SnllrAdapter extends BaseAdapter
{
    public const URL = 'https://bestel.snllr.nl/';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $getData = [
            'zipcode' => $this->postcode,
            'housenumber' => $this->houseNumber,
            'housenumberext' => $this->extension,
        ];
        $url = self::URL.'?'.http_build_query($getData);

        return $this->getAsync($url)->then(static fn (\Psr\Http\Message\ResponseInterface $response) => [
            'url' => $url,
            'html' => $response->getBody()->getContents(),
        ]);
    }

    public function getName(): string
    {
        return 'snllr';
    }
}
