<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class OdidoAdapter extends BaseAdapter
{
    public const URL = 'https://www.odido.nl/shop/internet/product/zelf-samenstellen';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        return \GuzzleHttp\Promise\Create::promiseFor([
            'url' => self::URL,
        ]);
    }

    public function getName(): string
    {
        return 'odido';
    }
}
