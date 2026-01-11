<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class BudgetAdapter extends BaseAdapter
{
    public const URL = 'https://api.budgetthuis.nl/internet/v1/signup-orders/addresses';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $url = self::URL.'/'.$this->postcode.'/'.$this->houseNumber.'/availability';
        if ($this->extension) {
            $url .= '?houseNumberExtension='.$this->extension;
        }

        return $this->getJsonAsync($url);
    }

    public function getName(): string
    {
        return 'budgetthuis';
    }
}
