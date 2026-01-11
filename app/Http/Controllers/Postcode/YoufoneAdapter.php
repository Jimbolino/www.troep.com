<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Promise\PromiseInterface;

class YoufoneAdapter extends BaseAdapter
{
    public const URL = 'https://www.youfone.nl/prov/order/GetCoverage';

    public function checkAsync(): PromiseInterface
    {
        $data = [
            'houseNumber' => $this->houseNumber,
            'houseNumberExtension' => $this->extension,
            'zipcode' => $this->postcode,
        ];

        $extraOptions = [
            'headers' => [
                'referer' => 'https://www.youfone.nl/thuis/bestellen',
            ],
        ];

        return $this->jsonPostAsync(self::URL, $data, $extraOptions);
    }

    public function getName(): string
    {
        return 'youfone';
    }
}
