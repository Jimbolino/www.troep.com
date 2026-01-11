<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class FiberAdapter extends BaseAdapter
{
    public const URL = 'https://api-aika.fiber.nl/api/address/check';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $data = [
            'postalCode' => $this->postcode,
            'houseNumber' => $this->houseNumber,
            'suffix' => $this->extension,
        ];

        return $this->jsonPostAsync(self::URL, $data);
    }

    public function getName(): string
    {
        return 'fiber';
    }
}
