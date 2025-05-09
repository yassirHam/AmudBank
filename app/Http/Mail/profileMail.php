<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProfileMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private User $user, private int $code)
    {
        // On envoie maintenant uniquement un code de vérification
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre code de vérification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email', 
            with: [
                'prenom' =>$this->user->Prenom,
                'name' => $this->user->Nom,
                'code' => $this->code,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
