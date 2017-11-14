<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CVSuggest extends Mailable
{
    use Queueable, SerializesModels;

    public $cvs;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cvs)
    {
        $this->cvs = $cvs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.fivecvs')
                    ->with([
                        'cvs' => $this->cvs
                    ]);
    }
}
