<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class DeltaAdapter extends BaseAdapter
{
    public const URL = 'https://api.delta.nl/orderstreet/v1/orderability';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $getData = [
            'isBusiness' => 'false',
            'postalcode' => $this->postcode,
            'housenumber' => $this->houseNumber,
        ];

        $url = self::URL.'?'.http_build_query($getData);

        return $this->getJsonAsync($url);
    }

    public function getName(): string
    {
        return 'delta';
    }
}
