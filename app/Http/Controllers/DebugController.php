<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Config\Repository;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    private Request $request;

    public function __construct(Request $request)
    {
        $ips = explode(',', env('DEBUG_IPS'));
        if (!\in_array($request->ip(), $ips, true)) {
            abort(403);
        }
        $this->request = $request;
    }

    public function get()
    {
        ksort($_ENV);

        return [
            'phpversion' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'variables_order' => ini_get('variables_order'),
            '_env' => $_ENV,
            'get_loaded_extensions' => get_loaded_extensions(),
        ];
    }

    public function config(Repository $config)
    {
        return $config->all();
    }

    public function phpinfo(): void
    {
        phpinfo();
    }

    public function cookie()
    {
        ksort($_COOKIE);

        return [
            '_cookie' => $_COOKIE,
            'request->cookie()' => $this->request->cookie(),
        ];
    }

    public function request()
    {
        ksort($_REQUEST);

        return [
            '_request' => $_REQUEST,
            'request->all()' => $this->request->all(),
        ];
    }

    public function server()
    {
        ksort($_SERVER);

        return [
            '_server' => $_SERVER,
            'request->server()' => $this->request->server(),
        ];
    }
}
