<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KliksafeAdapter extends BaseAdapter
{
    public const URL1 = 'https://www.kliksafe.nl/ajax/pakketten-zipcode-speed.php';
    public const URL2 = 'https://www.kliksafe.nl/ajax/pakketten-zipcode.php';

    public function check(): array
    {
        $options = [
            'query' => [
                'postcode' => $this->postcode,
                'huisnr' => $this->houseNumber,
                'toev' => '',
            ],
            'headers' => [
                'X-Requested-With' => 'XMLHttpRequest',
            ],
        ];

        $response1 = $this->client->get(self::URL1, $options);
        $response2 = $this->client->get(self::URL2, $options);

        return [
            json_decode($response1->getBody()->getContents()),
            json_decode($response2->getBody()->getContents()),
        ];
    }

    public function getName(): string
    {
        return 'kliksafe';
    }
}
