<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KpnAdapter extends BaseAdapter
{
    public const URL1 = 'https://www.kpn.com/shop/api/v1/offer/residential/activation/';
    public const URL2 = 'https://www.kpn.com/shop/zakelijk/api/v1/small-business/offer/residential/activation/';

    public function check($postcode, $houseNumber): array
    {
        $data = [
            'zip_code' => $postcode,
            'house_number' => $houseNumber,
        ];

        return [
            'kpn' => $this->jsonPost(self::URL1, $data),
            'kpn_zakelijk' => $this->jsonPost(self::URL2, $data),
        ];
    }

    public function getName(): string
    {
        return 'kpn';
    }
}
