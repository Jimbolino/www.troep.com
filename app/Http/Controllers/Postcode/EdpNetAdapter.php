<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class EdpNetAdapter extends BaseAdapter
{
    public const URL = 'https://www.edpnet.nl/nl/prive/internet.html';

    public function check($postcode, $houseNumber): array
    {
        $data = [
            'linetest_zip' => $postcode,
            'linetest_nr' => $houseNumber,
            'linetest_ext' => '',
        ];

        return $this->formPost(self::URL, $data);
    }

    public function getName(): string
    {
        return 'edpnet';
    }
}
