<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProxyController extends Controller
{
    public function get(Request $request)
    {
        $file = __DIR__.'/../../../resources/static/'.$request->path();

        return file_get_contents($file);
    }
}
