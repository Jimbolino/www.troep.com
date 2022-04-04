<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class TMobileAdapter extends BaseAdapter
{
    public const URL = 'https://www.t-mobile.nl/thuis/shop/product/zelf-samenstellen';

    public function check($postcode, $houseNumber): array
    {
        // TODO implement

        return [
            'url' => self::URL,
            'postcode' => $postcode,
            'houseNumber' => $houseNumber,
        ];
    }

    public function getName(): string
    {
        return 't-mobile';
    }
}
