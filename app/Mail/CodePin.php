<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodePin extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $code_securite;
    public $carte; 
    public function __construct($user, $code_securite, $carte)
    {
        $this->user = $user;
        $this->code_securite = $code_securite;
        $this->carte = $carte;
    }

    public function build()
    {
        return $this->subject('Votre CodeGuichet')
                    ->view('codepin');
    }
}