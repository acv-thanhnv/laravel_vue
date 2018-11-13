<?php

namespace App\Core\MailSender;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterSender extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->email;
        return $this->view('core.emails.register_successed',compact('email'));
    }
}
