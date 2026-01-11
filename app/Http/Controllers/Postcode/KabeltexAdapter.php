<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KabeltexAdapter extends BaseAdapter
{
    public const URL = 'https://kabeltex.nl/wp-admin/admin-ajax.php';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'action' => 'postcodecheck',
            'postcode' => $this->postcode,
            'huisnummer' => $this->houseNumber,
            'huisnummertoevoeging' => $this->extension,
        ];
        $options = [
            'headers' => [
                'x-requested-with' => 'XMLHttpRequest',
            ],
        ];

        return $this->formPostAsync(self::URL, $data, $options);
    }

    public function getName(): string
    {
        return 'kabeltex';
    }
}
