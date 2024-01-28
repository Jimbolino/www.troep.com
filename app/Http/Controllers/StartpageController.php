<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Factory;

class StartpageController extends Controller
{
    public function show(Factory $view, Request $request)
    {
        $cfIpCountry = $request->server->get('HTTP_CF_IPCOUNTRY') ?? 'NL';

        return $view->make('startpage', [
            'color' => $this->day2color(),
            'flag' => $this->country2flag($cfIpCountry),
            'ip' => $request->ip(),
        ]);
    }

    private function country2flag($countryCode)
    {
        $flags = array_map(static function ($char) {
            $codePoint = \ord($char) - \ord('A') + 0x1F1E6;

            return mb_convert_encoding('&#x'.dechex($codePoint).';', 'UTF-8', 'HTML-ENTITIES');
        }, str_split($countryCode));

        return implode('', $flags);
    }

    private function day2color()
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

        return $day2color[(int) date('N')];
    }
}
