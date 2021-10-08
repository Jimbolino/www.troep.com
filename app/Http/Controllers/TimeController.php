<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Factory;

class TimeController extends Controller
{
    public function show(Request $request, Factory $view)
    {
        $data = [
            'time' => date(DATE_COOKIE),
            'refresh' => max(1, abs((int) $request->input('refresh', 5))),
        ];

        return $view->make('time', $data);
    }
}
