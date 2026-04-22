<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $body;
    public $attachmentPath;

    public function __construct($subjectText, $body, $attachmentPath = null)
    {
        $this->subjectText = $subjectText;
        $this->body = $body;
        $this->attachmentPath = $attachmentPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.purchaseOrder',
            with: [
                'body' => $this->body
            ]
        );
    }

    public function attachments(): array
{
    if (!$this->attachmentPath) {
        return [];
    }
    
        $fullPath = storage_path('app/public/' . $this->attachmentPath);

    if (!file_exists($fullPath)) {
        throw new \Exception("Attachment not found: " . $fullPath);
    }


    return [
        Attachment::fromPath($fullPath)
    ];
}
}