<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class StarlinkAdapter extends BaseAdapter
{
    public const URL = 'https://www.starlink.com/';

    public function check($postcode, $houseNumber): array
    {
        return [
            'url' => self::URL,
            'postcode' => $postcode,
            'houseNumber' => $houseNumber,
        ];
    }

    public function getName(): string
    {
        return 'starlink';
    }
}
