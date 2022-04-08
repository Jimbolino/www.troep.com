<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KpnAdapter extends BaseAdapter
{
    public const URL = 'https://www.kpn.com/shop/api/v1/offer/residential/activation/';

    public function check(): array
    {
        $data = [
            'zip_code' => $this->postcode,
            'house_number' => (string) $this->houseNumber,
        ];

        return [
            $this->jsonPost(self::URL, $data),
        ];
    }

    public function getName(): string
    {
        return 'kpn';
    }
}
