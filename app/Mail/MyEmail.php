<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class MyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function sendEmail()
    {
        $email = 'luispittagroz@gmail.com';

        Mail::to($email)->send();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $title = 'dddsdasd';
        $content = 'fsdfsdfd';

        return $this->view('welcome')
            ->with(compact('title','content'));
    }
}
