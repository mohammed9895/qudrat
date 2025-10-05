<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpertRequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public ?string $message;

    public function __construct(
        string $name,
        ?string $message = null
    ) {
        $this->name = $name;
        $this->message = $message;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Expert Request Decision',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.expert-request-rejected',
            with: [
                'name' => $this->name,
                'message'=> $this->message,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
