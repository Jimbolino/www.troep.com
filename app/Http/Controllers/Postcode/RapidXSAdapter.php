<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class RapidXSAdapter extends BaseAdapter
{
    public const URL = 'https://portal.rapidxs.nl/api/zipcode/check?postNLOnly=false';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'zipcode' => $this->postcode,
            'houseNumber' => $this->houseNumber,
            'addition' => $this->extension,
            'extraInfo' => '',
        ];

        return $this->jsonPostAsync(self::URL, $data);
    }

    public function getName(): string
    {
        return 'rapidxs';
    }
}
