<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\Utils;

class ZiggoAdapter extends BaseAdapter
{
    public const FOOTPRINT_URL = 'https://api.prod.aws.ziggo.io/v2/api/rfsdata/v2/footprint/';
    public const AVAIL_URL = 'https://api.prod.aws.ziggo.io/v2/api/rfsdata/v2/availability/';
    public const GIGA_URL = 'https://api.prod.dcat.ziggo.io/campaign/v1/gigabit/';

    public function checkAsync(): PromiseInterface
    {
        $ext = null;
        if ($this->extension) {
            $ext = $this->extension;
        }

        $promises = [
            'footprint' => $this->getAsync(self::FOOTPRINT_URL.$this->postcode.'/'.$this->houseNumber),
            'availability' => $this->getAsync(self::AVAIL_URL.implode('', [$this->postcode, $this->houseNumber, $this->extension.$this->extension])),
            'gigabit' => $this->getAsync(self::GIGA_URL.implode('/', array_filter([$this->postcode, $this->houseNumber, $ext]))),
        ];

        return Utils::all($promises)->then(static fn ($responses) => [
            'footprint' => json_decode($responses['footprint']->getBody()->getContents()),
            'availability' => json_decode($responses['availability']->getBody()->getContents()),
            'gigabit' => json_decode($responses['gigabit']->getBody()->getContents()),
        ]);
    }

    public function getName(): string
    {
        return 'ziggo';
    }
}
