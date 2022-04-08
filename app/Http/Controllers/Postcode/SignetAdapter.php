<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SignetAdapter extends BaseAdapter
{
    public const URL = 'https://www.signet.nl/aanbod/internet/results/';

    public function check(): array
    {
        $data = [
            'postalCode' => $this->postcode,
            'houseNumber' => $this->houseNumber,
        ];

        $url = self::URL.'?'.http_build_query($data);

        $response = $this->client->get($url);
        $html = $response->getBody()->getContents();

        return [
            'url' => $url,
            'html' => $html,
        ];
    }

    public function getName(): string
    {
        return 'signet';
    }
}
