<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\View\Factory;

class IndexController extends Controller
{
    public function index(Factory $view)
    {
        return $view->make('index', ['randomQuote' => $this->randomQuote()]);
    }

    public function randomQuote()
    {
        $file = file_get_contents(__DIR__.'/../../../resources/quotes.json');
        if (!$file) {
            throw new Exception('file not found');
        }
        $quotes = json_decode($file, true);
        if (!\is_array($quotes)) {
            throw new Exception('file read error');
        }

        $rnd = random_int(0, \count($quotes) - 1);
        $randomQuote = $quotes[$rnd];

        if ($randomQuote['html']) {
            $result = nl2br($randomQuote['text']);
        } else {
            $result = nl2br(htmlspecialchars($randomQuote['text']));
        }
        if (!empty($randomQuote['copyright'])) {
            $result .= '<br /> - '.$randomQuote['copyright'];
        }

        return $result;
    }
}
