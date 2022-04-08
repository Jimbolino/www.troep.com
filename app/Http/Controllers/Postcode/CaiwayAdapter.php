<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class CaiwayAdapter extends BaseAdapter
{
    public const URL = 'https://www.caiway.nl/api/addresscheck';

    public function check(): array
    {
        $data = [
            'address' => [
                'zipcode' => $this->postcode,
                'housenumber' => $this->houseNumber,
                'addition' => '',
            ],
        ];

        return $this->jsonPost(self::URL, $data);
    }

    public function getName(): string
    {
        return 'caiway';
    }
}
