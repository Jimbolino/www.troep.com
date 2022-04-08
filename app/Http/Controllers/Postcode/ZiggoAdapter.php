<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class ZiggoAdapter extends BaseAdapter
{
    public const FOOTPRINT_URL = 'https://api.prod.aws.ziggo.io/v1/api/rfsdata/v1/footprint/';
    public const AVAIL_URL = 'https://api.prod.aws.ziggo.io/v1/api/rfsdata/v1/availability/';
    public const GIGA_URL = 'https://api.data.ziggo.nl/campaign/v1/gigabit/';

    public function check(): array
    {
        [$post, $code] = str_split($this->postcode, 4);

        $ext = null;
        if ($this->extension) {
            $ext = $this->extension;
        }

        $response1 = $this->client->get(self::FOOTPRINT_URL.$post.'/'.$code.'/'.$this->houseNumber);
        $response2 = $this->client->get(self::AVAIL_URL.implode('', [$this->postcode, $this->houseNumber, $this->extension.$this->extension])); // need better solution
        $response3 = $this->client->get(self::GIGA_URL.implode('/', array_filter([$this->postcode, $this->houseNumber, $ext])));

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
