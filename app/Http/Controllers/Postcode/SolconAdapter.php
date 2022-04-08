<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SolconAdapter extends BaseAdapter
{
    public const URL = 'https://www.solcon.nl/particulier/wp-admin/admin-ajax.php';

    public function check(): array
    {
        $data = [
            'action' => 'spock_data',
            'postcode' => $this->postcode,
            'house_no' => $this->houseNumber,
            'house_no_ext' => $this->extension,
            'customer_type' => 'p',
        ];

        return $this->formPost(self::URL, $data);
    }

    public function getName(): string
    {
        return 'solcon';
    }
}
