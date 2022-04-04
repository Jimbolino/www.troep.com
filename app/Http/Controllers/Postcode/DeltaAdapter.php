<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class DeltaAdapter extends BaseAdapter
{
    public const URL = 'https://www.delta.nl/bestellen/';

    public function check($postcode, $houseNumber): array
    {
        $getData = [
            'reset' => 'true',
            'postalCode' => $postcode,
            'houseNumber' => $houseNumber,
        ];

        $url = self::URL.'?'.http_build_query($getData);

        $request = $this->client->get($url);
        $html = $request->getBody()->getContents();

        return [
            'url' => $url,
            'html' => $html,
        ];
    }

    public function getName(): string
    {
        return 'delta';
    }
}
