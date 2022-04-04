<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class JonazAdapter extends BaseAdapter
{
    public const URL = 'https://www.jonaz.nl/producten/checker/';

    public function check($postcode, $houseNumber): array
    {
        $getData = [
            'zipcode' => $postcode,
            'number' => $houseNumber,
        ];

        $request = $this->client->get(self::URL.'?'.http_build_query($getData));
        $html = $request->getBody()->getContents();

        return [
            'url' => self::URL,
            'html' => $html,
        ];
    }

    public function getName(): string
    {
        return 'jonaz';
    }
}
