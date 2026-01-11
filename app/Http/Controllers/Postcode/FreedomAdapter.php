<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class FreedomAdapter extends BaseAdapter
{
    public const URL1 = 'https://freedom.nl/klant-worden/postcode'; // GET
    public const URL2 = 'https://freedom.nl/klant-worden/post'; // POST
    public const URL3 = 'https://freedom.nl/klant-worden/internet'; // GET

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'postcode' => $this->postcode,
            'huisnummer' => $this->houseNumber,
        ];

        return \GuzzleHttp\Promise\Create::promiseFor([
            'data' => $data,
            'url1' => self::URL1,
            'url2' => self::URL2,
            'url3' => self::URL3,
        ]);
    }

    public function getName(): string
    {
        return 'freedom';
    }
}
