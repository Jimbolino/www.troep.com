<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class CheapConnectAdapter extends BaseAdapter
{
    public const URL = 'https://www.cheapconnect.nl/ajax/getInternetCheck.php';

    public function check($postcode, $houseNumber): array
    {
        $data = [
            'zipcode' => $postcode,
            'housenr' => $houseNumber,
            'housenrext' => '',
        ];

        // TODO: parse html response
        $html = $this->formPost(self::URL, $data);

        return [
            'url' => self::URL,
            'html' => $html,
        ];
    }

    public function getName(): string
    {
        return 'cheapconnect';
    }
}
