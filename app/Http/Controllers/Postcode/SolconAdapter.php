<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SolconAdapter extends BaseAdapter
{
    public const URL = 'https://api.solcon.nl/availability-checker/filtered';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'postcode' => $this->postcode,
            'house_no' => $this->houseNumber,
            'house_no_ext' => $this->extension,
            'customer_type' => 'p',
        ];

        $url = self::URL.'?'.http_build_query($data);

        return $this->getJsonAsync($url, $data);
    }

    public function getName(): string
    {
        return 'solcon';
    }
}
