<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class KabeltexAdapter extends BaseAdapter
{
    public const URL = 'https://noordkop.kabeltex.nl/wp-admin/admin-ajax.php';

    public function check(): array
    {
        $data = [
            'action' => 'inschrijving_postcode_check',
            'inschrijving_postcode' => $this->postcode,
            'inschrijving_huisnummer' => $this->houseNumber,
            'inschrijving_huisnummertoevoeging' => '',
        ];
        $options = [
            'headers' => [
                'x-requested-with' => 'XMLHttpRequest',
            ],
        ];

        return $this->formPost(self::URL, $data, $options);
    }

    public function getName(): string
    {
        return 'kabeltex';
    }
}
