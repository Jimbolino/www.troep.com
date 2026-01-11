<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Cookie\CookieJar;

class HeldenVanNuAdapter extends BaseAdapter
{
    public const URL = 'https://www.heldenvan.nu/bestellen';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'zipCode' => $this->postcode,
            'housenumber' => $this->houseNumber,
            'housenumber_extension' => $this->extension,
        ];
        $options = [
            'verify' => false,
            'cookies' => new CookieJar(),
        ];

        return $this->formPostHTMLAsync(self::URL, $data, $options)->then(static fn ($html) => [
            'url' => self::URL,
            'html' => $html,
        ]);
    }

    public function getName(): string
    {
        return 'heldenvannu';
    }
}
