<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailManager extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $array;

    public function __construct($array)
    {
        $this->array = $array;
    }
    public function build()
    {
        return $this->view($this->array['view'], $this->array)
            ->from($this->array['from'], env('MAIL_FROM_NAME'))
            ->subject($this->array['subject']);
    }
}
