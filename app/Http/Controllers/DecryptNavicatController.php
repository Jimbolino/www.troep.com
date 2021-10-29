<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class DecryptNavicatController
{
    public const DEFAULT_HASH = 'E75BF077AB8BAA3AC2D5';
    public const DEFAULT_VERSION = 11;

    public function show(Request $request)
    {
        $data = [
            'result' => null,
            'defaultHash' => self::DEFAULT_HASH,
            'defaultVersion' => self::DEFAULT_VERSION,
        ];
        if ($request->get('version') && $request->get('password')) {
            $data['result'] = $this->decrypt((int) $request->get('version'), $request->get('password'));
        }

        return view('navicat', $data);
    }

    public function decrypt(int $version, string $password)
    {
        if ($version < 11 || $version > 15) {
            throw new Exception('version should be between 11 or 15');
        }
        if (empty($password)) {
            throw new Exception('password empty');
        }

        $navicatPassword = new NavicatPassword($version);

        return $navicatPassword->decrypt($password);
    }
}
