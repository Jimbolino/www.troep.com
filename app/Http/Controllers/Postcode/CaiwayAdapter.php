<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class CaiwayAdapter extends BaseAdapter
{
    public const URL = 'https://www.caiway.nl/';

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
        return 'caiway';
    }
}
