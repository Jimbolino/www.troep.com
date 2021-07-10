<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Factory;

class IpController extends Controller
{
    public function show(Factory $view, Request $request)
    {
        $ip = $request->ip() ?? '127.0.0.1';

        $data = [
            'ip' => $ip,
            'hostname' => gethostbyaddr($ip),
        ];

        return $view->make('ip', $data);
    }
}
