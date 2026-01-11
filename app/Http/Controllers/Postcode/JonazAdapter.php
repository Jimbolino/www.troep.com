<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class JonazAdapter extends BaseAdapter
{
    public const URL = 'https://www.jonaz.nl/wp-admin/admin-ajax.php';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'post_id' => 49,
            'form_id' => '9a327bf',
            'referer_title' => 'Home - Jonaz | Internet, TV & Bellen',
            'query_id' => 49,
            'form_fields[zipcode]' => $this->postcode,
            'form_fields[housenumber]' => $this->houseNumber,
            'form_fields[housenumber_extension]' => $this->extension,
            'action' => 'jonaz_ajax_form_submit',
            'referer' => 'https://www.jonaz.nl/',
        ];

        return $this->formPostAsync(self::URL, $data);
    }

    public function getName(): string
    {
        return 'jonaz';
    }
}
