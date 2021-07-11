<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProxyController extends Controller
{
    public function get(Request $request): BinaryFileResponse
    {
        $file = __DIR__.'/../../../resources/static/'.$request->path();

        return new BinaryFileResponse($file);
    }
}
