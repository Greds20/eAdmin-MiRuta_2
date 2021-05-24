<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class eAdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Recuperación de contraseña eAdmin MiRuta';
    public $msg;

    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    public function build()
    {
        return $this->view('emails.passRecovered');
    }
}
