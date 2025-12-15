<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class JornadaMail extends Mailable
{
    use Queueable, SerializesModels;

    // Fíjate que tenga el $ antes de partits
    public function __construct(public Collection $partits) {}

    public function envelope(): Envelope
    {
        // Fíjate en los $
        $jornada = $this->partits->first()->jornada ?? '?';
        return new Envelope(subject: "Resum Jornada $jornada");
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.jornada');
    }
}