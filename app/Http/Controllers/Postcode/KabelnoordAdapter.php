<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KabelnoordAdapter extends BaseAdapter
{
    public const URL = 'https://www.kabelnoord.nl/bestellen';

    public function check(): array
    {
        $data = [
            'zipcode' => $this->postcode,
            'number' => $this->houseNumber,
            'addition' => $this->extension,
            'room' => '',
            'check-zipcode' => 'check-zipcode',
        ];

        $html = $this->formPostHTML(self::URL, $data);

        return [
            'url' => self::URL,
            'html' => $html,
        ];
    }

    public function getName(): string
    {
        return 'kabelnoord';
    }
}
