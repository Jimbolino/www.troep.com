<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class ZiggoAdapter extends BaseAdapter
{
    public const FOOTPRINT_URL = 'https://api.prod.aws.ziggo.io/v1/api/rfsdata/v1/footprint/';
    public const AVAIL_URL = 'https://api.prod.aws.ziggo.io/v1/api/rfsdata/v1/availability/';
    public const GIGA_URL = 'https://api.data.ziggo.nl/campaign/v1/gigabit/';

    public function check($postcode, $houseNumber): array
    {
        [$post, $code] = str_split($postcode, 4);

        $response1 = $this->client->get(self::FOOTPRINT_URL.$post.'/'.$code.'/'.$houseNumber);
        $response2 = $this->client->get(self::AVAIL_URL.$postcode.$houseNumber);
        $response3 = $this->client->get(self::GIGA_URL.$postcode.'/'.$houseNumber);

        return [
            'footprint' => json_decode($response1->getBody()->getContents()),
            'availability' => json_decode($response2->getBody()->getContents()),
            'gigabit' => json_decode($response3->getBody()->getContents()),
        ];
    }

    public function getName(): string
    {
        return 'ziggo';
    }
}