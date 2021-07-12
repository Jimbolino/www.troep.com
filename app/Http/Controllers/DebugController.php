<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function get(Request $request)
    {
        $ips = explode(',', env('DEBUG_IPS'));
        if (!in_array($request->ip(), $ips)) {
            abort(403);
        }

        ksort($_ENV);
        ksort($_SERVER);
        ksort($_REQUEST);
        ksort($_COOKIE);

        return [
            'env' => $_ENV,
            'server' => $_SERVER,
            'request' => $_REQUEST,
            'cookie' => $_COOKIE,
        ];
    }
}

