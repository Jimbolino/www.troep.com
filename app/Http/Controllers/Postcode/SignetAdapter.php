<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SignetAdapter extends BaseAdapter
{
    public const URL = 'https://www.signet.nl/aanbod/internet/results/';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'postalCode' => $this->postcode,
            'houseNumber' => $this->houseNumber,
        ];

        $url = self::URL.'?'.http_build_query($data);

        return $this->getAsync($url)->then(static fn (\Psr\Http\Message\ResponseInterface $response) => [
            'url' => $url,
            'html' => $response->getBody()->getContents(),
        ]);
    }

    public function getName(): string
    {
        return 'signet';
    }
}
