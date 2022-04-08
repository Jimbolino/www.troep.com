<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class TMobileAdapter extends BaseAdapter
{
    public const URL = 'https://www.t-mobile.nl/thuis/shop/product/zelf-samenstellen';

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
        return 't-mobile';
    }
}
