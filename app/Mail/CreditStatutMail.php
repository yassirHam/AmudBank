<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreditStatutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $statut;

    public function __construct($user, $statut)
    {
        $this->user = $user;
        $this->statut = $statut;
    }

    public function build()
    {
        return $this->subject('Statut de votre demande de crédit')
                    ->view('creditstatut');
    }
}