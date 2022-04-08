<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SkvAdapter extends BaseAdapter
{
    public const URL = 'https://www.skv.nl/pccheck/pcc.php';

    public function check(): array
    {
        $url = self::URL.'?'.$this->postcode;

        $request = $this->client->get($url);

        return [
            'html' => $request->getBody()->getContents(),
        ];
    }

    public function getName(): string
    {
        return 'skv';
    }
}
