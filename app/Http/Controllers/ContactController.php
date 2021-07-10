<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\Factory;

class ContactController extends Controller
{
    public function show(Factory $view)
    {
        return $view->make('contact');
    }

    public function send()
    {
        return 'TODO: fixme';
    }
}
