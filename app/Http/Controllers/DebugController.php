<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function __construct(Request $request)
    {
        $ips = explode(',', env('DEBUG_IPS'));
        if (!\in_array($request->ip(), $ips, true)) {
            abort(403);
        }
    }

    public function get()
    {
        ksort($_ENV);
        ksort($_SERVER);
        ksort($_REQUEST);
        ksort($_COOKIE);

        return [
            'env' => $_ENV,
            'server' => $_SERVER,
            'request' => $_REQUEST,
            'cookie' => $_COOKIE,
            'phpversion' => PHP_VERSION,
            'get_loaded_extensions' => get_loaded_extensions(),
        ];
    }

    public function phpinfo(): void
    {
        phpinfo();
    }
}
