<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class GlasnetAdapter extends BaseAdapter
{
    public const URL = 'https://grm.glasnet.nl/api/getServices/';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $url = self::URL.$this->postcode.'/'.$this->houseNumber;

        return $this->getJsonAsync($url);
    }

    public function getName(): string
    {
        return 'glasnet';
    }
}
