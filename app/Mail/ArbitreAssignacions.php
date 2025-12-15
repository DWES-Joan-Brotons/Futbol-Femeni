<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class ArbitreAssignacions extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Rebem l'àrbitre i la llista de partits al constructor.
     */
    public function __construct(public User $arbitre, public Collection $partits) {}

    /**
     * Definim l'assumpte del correu.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Assignacions de Partits - ' . config('app.name'),
        );
    }

    /**
     * Definim la vista que s'utilitzarà.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.arbitre-assignacions',
        );
    }
}