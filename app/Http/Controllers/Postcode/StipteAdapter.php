<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class StipteAdapter extends BaseAdapter
{
    public const URL = 'https://www.stipte.nl/wp-admin/admin-ajax.php';

    public function check($postcode, $houseNumber): array
    {
        $data = [
            'action' => 'st_order_xml_getzip',
            'zipcode' => $postcode,
            'number' => $houseNumber,
            'houseadd' => '',
            'campaign' => 'all',
        ];

        return $this->formPost(self::URL, $data);
    }

    public function getName(): string
    {
        return 'stipte';
    }
}
