<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class StarlinkAdapter extends BaseAdapter
{
    public const URL = 'https://www.starlink.com/';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        return new \GuzzleHttp\Promise\FulfilledPromise([
            'url' => self::URL,
        ]);
    }

    public function getName(): string
    {
        return 'starlink';
    }
}
