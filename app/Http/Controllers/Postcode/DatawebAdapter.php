<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class DatawebAdapter extends BaseAdapter
{
    public const URL = 'https://www.dataweb.nl/postcode-check-zakelijk-glasvezel/';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'postcode' => $this->postcode,
            'huisnummer' => $this->houseNumber,
        ];

        $url = self::URL.'?'.http_build_query($data);

        return $this->getAsync($url)->then(static fn (\Psr\Http\Message\ResponseInterface $response) => [
            'html' => $response->getBody()->getContents(),
        ]);
    }

    public function getName(): string
    {
        return 'dataweb';
    }
}
