<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Promise\PromiseInterface;

class OnlineAdapter extends BaseAdapter
{
    public const URL = 'https://www.online.nl/actions.online.nl/m7actions/addresscheck/checkaddress/';

    public function checkAsync(): PromiseInterface
    {
        $data = [
            'PostalCode' => $this->postcode,
            'HouseNumber' => $this->houseNumber,
            'IsUnverified' => 'false',
            'BasketId' => 'b21670da-d9fe-49eb-a62e-5730ff9db48c',
            'LoadCompleteAddress' => 'false',
        ];
        $options = [
            'headers' => [
                'x-requested-with' => 'XMLHttpRequest',
            ],
        ];

        return $this->jsonPostAsync(self::URL, $data, $options);
    }

    public function getName(): string
    {
        return 'online';
    }
}
