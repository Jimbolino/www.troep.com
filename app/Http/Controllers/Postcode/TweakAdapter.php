<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class TweakAdapter extends BaseAdapter
{
    public const URL = 'https://tweak.nl/bestellen/';

    public function check(): array
    {
        return [
            'url' => self::URL,
            'postcode' => $this->postcode,
            'houseNumber' => $this->houseNumber,
        ];
    }

    public function getName(): string
    {
        return 'tweak';
    }
}
