<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Promise\PromiseInterface;

class KpnAdapter extends BaseAdapter
{
    public const URL = 'https://www.kpn.com/shop/api/v1/offer/residential/activation/';
    public const COOKIE_URL = 'https://www.kpn.com/shop/pakket-zelf-samenstellen?tv=ja';

    public function checkAsync(): PromiseInterface
    {
        $jar = new CookieJar();

        return $this->getAsync(self::COOKIE_URL, [
            'headers' => [
                'user-agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36',
            ],
            'cookies' => $jar,
        ])->then(function () use ($jar) {
            $data = [
                'house_number' => (string) $this->houseNumber,
                'zip_code' => $this->postcode,
            ];

            return $this->jsonPostAsync(self::URL, $data, ['cookies' => $jar]);
        });
    }

    public function getName(): string
    {
        return 'kpn';
    }
}
