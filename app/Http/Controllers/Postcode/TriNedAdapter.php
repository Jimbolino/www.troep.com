<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class TriNedAdapter extends BaseAdapter
{
    public const URL = 'https://www.trined.nl/bestellen/';

    public function check(): array
    {
        $url = self::URL.$this->postcode.'/'.$this->houseNumber;

        $response = $this->client->get($url);

        return [
            'url' => $url,
            'html' => $response->getBody()->getContents(),
        ];
    }

    public function getName(): string
    {
        return 'trined';
    }
}
