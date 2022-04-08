<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KpnZakelijkAdapter extends KpnAdapter
{
    public const URL = 'https://www.kpn.com/shop/zakelijk/api/v1/small-business/offer/residential/activation/';

    public function check(): array
    {
        $data = [
            'zip_code' => $this->postcode,
            'house_number' => $this->houseNumber,
        ];

        return [
            $this->jsonPost(self::URL, $data),
        ];
    }

    public function getName(): string
    {
        return 'kpn-zakelijk';
    }
}
