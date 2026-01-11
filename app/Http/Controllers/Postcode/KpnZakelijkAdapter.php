<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KpnZakelijkAdapter extends KpnAdapter
{
    public const URL = 'https://www.kpn.com/shop/api/v1/small-business/offer/residential/activation/';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'house_number' => (string) $this->houseNumber,
            'zip_code' => $this->postcode,
        ];

        $extraOptions = [
            'headers' => [
                'user-agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36',
            ],
        ];

        return $this->jsonPostAsync(self::URL, $data, $extraOptions);
    }

    public function getName(): string
    {
        return 'kpn-zakelijk';
    }
}
