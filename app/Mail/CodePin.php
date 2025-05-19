<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodePin extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $code;
    public $carte; 
    public function __construct($user, $code, $carte)
    {
        $this->user = $user;
        $this->code = $code;
        $this->carte = $carte;
    }

    public function build()
    {
        return $this->subject('Votre code PIN de vérification')
                    ->view('codepin');
    }
}