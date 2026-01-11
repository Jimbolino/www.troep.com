<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\View\Factory;

class ViewSourceController extends Controller
{
    public function show(Request $request, Factory $view)
    {
        $url = $request->get('url', 'http://troep.com/');

        if (!filter_var($url, \FILTER_VALIDATE_URL)) {
            throw new Exception('invalid_url filter_var');
        }
        if (!preg_match('/^https?:\/\//', $url)) {
            throw new Exception('invalid_url preg_match');
        }

        $data = [
            'url' => $url,
            'contents' => @file_get_contents($url),
            'http_response_header' => $http_response_header,
        ];

        return $view->make('viewsource', $data);
    }
}
