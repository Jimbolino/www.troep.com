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
            'time' => strftime('%H:%M:%S - %b %d %Y'),
            'refresh' => max(1, abs($request->input('refresh', 5))),
        ];

        return $view->make('time', $data);
    }
}
