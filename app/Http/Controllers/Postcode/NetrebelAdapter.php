<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class NetrebelAdapter extends BaseAdapter
{
    public const URL = 'https://netrebel.nl/';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'postcode' => $this->postcode,
            'huisnummer' => $this->houseNumber,
            'toevoeging' => $this->extension,
            'kamer' => '',
            'email' => '',
        ];
        $options = [
            'headers' => [
                'X-OCTOBER-REQUEST-HANDLER' => 'qtSignUpForm::onSubmitRequestForm',
                'X-Requested-With' => 'XMLHttpRequest',
            ],
        ];

        return $this->formPostAsync(self::URL, $data, $options);
    }

    public function getName(): string
    {
        return 'netrebel';
    }
}
