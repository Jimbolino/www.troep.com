<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class EdpNetAdapter extends BaseAdapter
{
    public const URL = 'https://www.edpnet.nl/nl/prive/internet.html';

    public function check(): array
    {
        $data = [
            'linetest_zip' => $this->postcode,
            'linetest_nr' => $this->houseNumber,
            'linetest_ext' => $this->extension,
        ];

        return $this->formPost(self::URL, $data);
    }

    public function getName(): string
    {
        return 'edpnet';
    }
}
