<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Promise\PromiseInterface;

interface AdapterInterface
{
    public function check(): array;

    public function checkAsync(): PromiseInterface;

    public function getName(): string;
}
