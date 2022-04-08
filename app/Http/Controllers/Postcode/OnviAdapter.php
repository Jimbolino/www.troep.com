<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class OnviAdapter extends BaseAdapter
{
    public const URL = 'https://mijn.onvi.nl/bestellen/';

    public function check(): array
    {
        $data = [
            'postalcode' => $this->postcode,
            'housenumber' => $this->houseNumber,
            'extension' => '',
        ];

        $response = $this->client->get(self::URL, ['query' => $data]);
        $html = $response->getBody()->getContents();

        return [
            'html' => $html,
        ];
    }

    public function getName(): string
    {
        return 'onvi';
    }
}
