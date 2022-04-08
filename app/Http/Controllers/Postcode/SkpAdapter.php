<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SkpAdapter extends BaseAdapter
{
    public const URL = 'https://skpnet.nl/wp-admin/admin-ajax.php';

    public function check(): array
    {
        $data = [
            'action' => 'gfpcnlgetaddress',
            'nonce' => '4301f30efe',
            'form_id' => '1',
            'field_id' => '83',
            'postcode' => $this->postcode,
            'huisnummer' => $this->houseNumber,
            'toevoeging' => '',
        ];

        $url = self::URL.'?'.http_build_query($data);

        $response = $this->client->get($url);

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    public function getName(): string
    {
        return 'skp';
    }
}
