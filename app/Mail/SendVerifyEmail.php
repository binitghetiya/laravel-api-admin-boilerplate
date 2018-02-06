<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerifyEmail extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email = null;
    public $username = null;
    public $link = null;

    public function __construct($email, $username, $link) {
        $this->email = $email;
        $this->username = $username;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $subject = 'Verify you email -' . config('app.name');
        return $this->markdown('mails.sendverify')
                        ->subject($subject);
    }

}
