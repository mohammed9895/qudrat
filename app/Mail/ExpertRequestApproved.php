<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpertRequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $requestTitle;
    public string $referenceId;
    public string $submittedAt;
    public string $actionUrl;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Expert Request Approved',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.expert-request-approved',
            with: [
                'name' => $this->name,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
