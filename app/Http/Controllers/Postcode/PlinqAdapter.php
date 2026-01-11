<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class PlinqAdapter extends BaseAdapter
{
    public const URL = 'https://www.plinq.nl/wp-admin/admin-ajax.php';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'action' => 'plinqapi',
            'zipcode' => $this->postcode,
            'houseno' => $this->houseNumber,
            'houseno_ext' => $this->extension,
            'type' => 'thuis',
        ];
        $options = [
            'verify' => false,
        ];

        return $this->formPostAsync(self::URL, $data, $options);
    }

    public function getName(): string
    {
        return 'plinq';
    }
}
