<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SnlrAdapter extends BaseAdapter
{
    public const URL = 'https://www.snlr-glasvezel.nl/postcodecheckfeed/';

    public function check(): array
    {
        $url = self::URL.$this->postcode.'/'.$this->houseNumber.'/.json';

        $response = $this->client->get($url);

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    public function getName(): string
    {
        return 'snlr';
    }
}
