<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class FreedomAdapter extends BaseAdapter
{
    public const URL = 'https://freedom.nl/klant-worden/internet';

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
        return 'freedom';
    }
}
