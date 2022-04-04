<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class BudgetAdapter extends BaseAdapter
{
    public const URL = 'https://www.budgetthuis.nl/alles-in-1/xhr/checkAddress';

    public function check($postcode, $houseNumber): array
    {
        $data = [
            'address_check_form' => [
                'address' => [
                    'postalCode' => $postcode,
                    'houseNumber' => $houseNumber,
                    'houseNumberExtension' => '',
                ],
                'isEnergyClient' => 0,
            ],
        ];

        return $this->formPost(self::URL, $data);
    }

    public function getName(): string
    {
        return 'budgetthuis';
    }
}
