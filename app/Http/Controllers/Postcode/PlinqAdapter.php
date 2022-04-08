<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class PlinqAdapter extends BaseAdapter
{
    public const URL = 'https://www.plinq.nl/wp-admin/admin-ajax.php';

    public function check(): array
    {
        $data = [
            'action' => 'plinqapi',
            'zipcode' => $this->postcode,
            'houseno' => $this->houseNumber,
            'houseno_ext' => '',
            'type' => 'thuis',
        ];

        $options = [
            'verify' => false,
        ];

        return $this->formPost(self::URL, $data, $options);
    }

    public function getName(): string
    {
        return 'plinq';
    }
}
