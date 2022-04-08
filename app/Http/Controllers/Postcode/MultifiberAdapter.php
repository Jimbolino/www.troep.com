<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class MultifiberAdapter extends BaseAdapter
{
    public const URL = 'https://portal.multifiber.nl/api/zipcode/check?postNLOnly=false';

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
        return 'multifiber';
    }
}
