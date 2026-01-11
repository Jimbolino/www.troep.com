<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KabelnoordAdapter extends BaseAdapter
{
    public const URL = 'https://www.kabelnoord.nl/bestellen';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'zipcode' => $this->postcode,
            'number' => $this->houseNumber,
            'addition' => $this->extension,
            'room' => '',
            'check-zipcode' => 'check-zipcode',
        ];

        return $this->formPostHTMLAsync(self::URL, $data)->then(static fn ($html) => [
            'url' => self::URL,
            'html' => $html,
        ]);
    }

    public function getName(): string
    {
        return 'kabelnoord';
    }
}
