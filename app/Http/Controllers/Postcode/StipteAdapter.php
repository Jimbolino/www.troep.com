<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class StipteAdapter extends BaseAdapter
{
    public const URL = 'https://www.stipte.nl/wp-admin/admin-ajax.php';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'action' => 'st_order_xml_getzip',
            'zipcode' => $this->postcode,
            'number' => $this->houseNumber,
            'houseadd' => '',
            'campaign' => 'all',
        ];

        return $this->formPostAsync(self::URL, $data);
    }

    public function getName(): string
    {
        return 'stipte';
    }
}
