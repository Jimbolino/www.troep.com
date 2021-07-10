<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\Factory;

class StartpageController extends Controller
{
    public function show(Factory $view)
    {
        $day2color = [
            1 => 'yellow',
            2 => '#ffccff',
            3 => '#7fff7f',
            4 => '#ff9900',
            5 => '#33ccff',
            6 => '#993399',
            7 => 'red',
        ];
        $color = $day2color[(int) date('N')];

        return $view->make('startpage', ['color' => $color]);
    }
}
