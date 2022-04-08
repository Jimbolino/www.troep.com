<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class StarlinkAdapter extends BaseAdapter
{
    public const URL = 'https://www.starlink.com/';

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
        return 'starlink';
    }
}
