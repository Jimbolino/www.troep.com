<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

interface AdapterInterface
{
    public function check(): array;

    public function getName(): string;
}
