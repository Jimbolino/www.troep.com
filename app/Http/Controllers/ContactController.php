<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmit;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\View\Factory;

class ContactController extends Controller
{
    public function show(Factory $view)
    {
        return $view->make('contact');
    }

    public function send(Request $request, Mailer $mailer)
    {
        $mail = new ContactFormSubmit($request);
        $mail->to(env('MAIL_TO_ADDRESS'));
        $mail->send($mailer);

        return 'thnx for your mail';
    }
}
