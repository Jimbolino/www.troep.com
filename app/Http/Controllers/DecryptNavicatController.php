<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class DecryptNavicatController
{
    public function show(Request $request)
    {
        $result = null;
        if ($request->get('version') && $request->get('password')) {
            $result = $this->decrypt((int) $request->get('version'), $request->get('password'));
        }

        return view('navicat', ['result' => $result]);
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
