<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmit extends Mailable
{
    use Queueable;
    use SerializesModels;

    private array $data;

    /**
     * Create a new message instance.
     */
    public function __construct(Request $request)
    {
        $this->data = $request->except(['_token', 'submit']);

        $this->data['userAgent'] = $request->server('HTTP_USER_AGENT');
        $this->data['dateTime'] = strftime('%H:%M:%S - %b %d %Y');
        $this->data['ip'] = $request->ip() ?? '';
        $this->data['hostname'] = gethostbyaddr($this->data['ip']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('contactmail')->with([
            'data' => $this->data,
        ]);
    }
}
