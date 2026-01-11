<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SkpAdapter extends BaseAdapter
{
    public const URL = 'https://skpnet.nl/wp-admin/admin-ajax.php';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'action' => 'gfpcnlgetaddress',
            'nonce' => 'a4e2c62906',
            'form_id' => '23',
            'field_id' => '83',
            'postcode' => $this->postcode,
            'huisnummer' => $this->houseNumber,
            'toevoeging' => $this->extension,
        ];

        $url = self::URL.'?'.http_build_query($data);

        return $this->getJsonAsync($url);
    }

    public function getName(): string
    {
        return 'skp';
    }
}
