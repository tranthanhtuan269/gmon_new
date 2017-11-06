<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobSuggest extends Mailable
{
    use Queueable, SerializesModels;

    public $jobs;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcomeNew')
                    ->with([
                        'jobs' => $this->jobs
                    ]);
    }
}
