<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Poliza;

class RenovacionReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $poliza;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Poliza $poliza)
    {
        $this->poliza = $poliza;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.poliza');
    }
}
