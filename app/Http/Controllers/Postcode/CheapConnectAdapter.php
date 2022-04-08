<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class CheapConnectAdapter extends BaseAdapter
{
    public const URL = 'https://www.cheapconnect.nl/ajax/getInternetCheck.php';

    public function check(): array
    {
        $data = [
            'zipcode' => $this->postcode,
            'housenr' => $this->houseNumber,
            'housenrext' => $this->extension,
        ];

        $html = $this->formPostHTML(self::URL, $data);

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
