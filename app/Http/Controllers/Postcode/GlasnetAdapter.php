<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class GlasnetAdapter extends BaseAdapter
{
    public const URL = 'https://grm.glasnet.nl/api/getServices/';

    public function check(): array
    {
        $url = self::URL.$this->postcode.'/'.$this->houseNumber;

        $response = $this->client->get($url);

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    public function getName(): string
    {
        return 'glasnet';
    }
}
