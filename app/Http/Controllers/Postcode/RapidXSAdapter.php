<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class RapidXSAdapter extends BaseAdapter
{
    public const URL = 'https://portal.rapidxs.nl/api/zipcode/check?postNLOnly=false';

    public function check(): array
    {
        $data = [
            'zipcode' => $this->postcode,
            'houseNumber' => $this->houseNumber,
            'addition' => '',
            'extraInfo' => '',
        ];

        return $this->jsonPost(self::URL, $data);
    }

    public function getName(): string
    {
        return 'rapidxs';
    }
}
