<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KliksafeAdapter extends BaseAdapter
{
    public const URL1 = 'https://www.kliksafe.nl/ajax/pakketten-zipcode-speed.php';
    public const URL2 = 'https://www.kliksafe.nl/ajax/pakketten-zipcode.php';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $options = [
            'query' => [
                'postcode' => $this->postcode,
                'huisnr' => $this->houseNumber,
                'toev' => $this->extension,
            ],
            'headers' => [
                'X-Requested-With' => 'XMLHttpRequest',
            ],
        ];

        $promises = [
            'res1' => $this->getAsync(self::URL1, $options),
            'res2' => $this->getAsync(self::URL2, $options),
        ];

        return \GuzzleHttp\Promise\Utils::all($promises)->then(static fn ($responses) => [
            json_decode($responses['res1']->getBody()->getContents()),
            json_decode($responses['res2']->getBody()->getContents()),
        ]);
    }

    public function getName(): string
    {
        return 'kliksafe';
    }
}
