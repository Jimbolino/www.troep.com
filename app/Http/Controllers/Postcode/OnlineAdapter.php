<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class OnlineAdapter extends BaseAdapter
{
    public const URL = 'https://www.online.nl/actions.online.nl/m7actions/addresscheck/checkaddress/';

    public function check($postcode, $houseNumber): array
    {
        $data = [
            'PostalCode' => $postcode,
            'HouseNumber' => $houseNumber,
            'IsUnverified' => 'false',
            'BasketId' => '6e2c353d-c3d3-4647-959d-fd35016dd33e',
            'LoadCompleteAddress' => 'false',
        ];
        $options = [
            'headers' => [
                'x-requested-with' => 'XMLHttpRequest',
            ],
        ];

        return $this->jsonPost(self::URL, $data, $options);
    }

    public function getName(): string
    {
        return 'online';
    }
}
