<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Cookie\CookieJar;

class HeldenVanNuAdapter extends BaseAdapter
{
    public const URL = 'https://bestel.heldenvan.nu/aansluitadres';

    public function check(): array
    {
        $data = [
            'utf8' => '✓',
            'address[zipcode]' => $this->postcode,
            'address[number]' => $this->houseNumber,
            'address[number_extra]' => $this->extension,
        ];

        $options = [
            'verify' => false,
            'cookies' => new CookieJar(),
        ];

        $html = $this->formPostHTML(self::URL, $data, $options);

        return [
            'html' => $html,
        ];
    }

    public function getName(): string
    {
        return 'heldenvannu';
    }
}
