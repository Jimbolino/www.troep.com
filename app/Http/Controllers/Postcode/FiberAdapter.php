<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class FiberAdapter extends BaseAdapter
{
    public const URL = 'https://api.aika.fiber.nl/api/address/check';

    public function check($postcode, $houseNumber): array
    {
        $data = [
            'postalCode' => $postcode,
            'houseNumber' => $houseNumber,
            'houseNumberExt' => '',
        ];
        $options = [
            'http_errors' => false,
            'headers' => [
                'X-Order-App-Version' => '1.2.5',
            ],
        ];

        return $this->jsonPost(self::URL, $data, $options);
    }

    public function getName(): string
    {
        return 'fiber';
    }
}
