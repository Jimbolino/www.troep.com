<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class CheapConnectAdapter extends BaseAdapter
{
    public const URL = 'https://www.cheapconnect.nl/ajax/getInternetCheck.php';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'zipcode' => $this->postcode,
            'housenr' => $this->houseNumber,
            'housenrext' => $this->extension,
        ];

        return $this->formPostHTMLAsync(self::URL, $data)->then(static fn ($html) => [
            'url' => self::URL,
            'html' => $html,
        ]);
    }

    public function getName(): string
    {
        return 'cheapconnect';
    }
}
