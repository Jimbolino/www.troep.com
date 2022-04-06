<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class YoufoneAdapter extends BaseAdapter
{
    public const URL = 'https://www.youfone.nl/prov/order/PostcodeCheckCoverage';

    public function check($postcode, $houseNumber): array
    {
        $data = [
            'request' => [
                'Zipcode' => $postcode,
                'HouseNr' => $houseNumber,
                'HouseNrExtension' => '',
            ],
        ];

        return $this->jsonPost(self::URL, $data);
    }

    public function getName(): string
    {
        return 'youfone';
    }
}