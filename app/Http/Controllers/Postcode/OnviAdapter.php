<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class OnviAdapter extends BaseAdapter
{
    public const URL = 'https://api-staging.qonnected.net/postal-code/public-products?brand=onvi';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'postalcode' => $this->postcode,
            'housenr' => $this->houseNumber,
            'ext' => $this->extension,
        ];

        return $this->jsonPostAsync(self::URL, $data);
    }

    public function getName(): string
    {
        return 'onvi';
    }
}
