<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageModel;
    public $replySubject;
    public $replyContent;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactMessage $messageModel, string $replySubject, string $replyContent)
    {
        $this->messageModel = $messageModel;
        $this->replySubject = $replySubject;
        $this->replyContent = $replyContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->replySubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.customer-reply',
            with: [
                'messageModel' => $this->messageModel,
                'replySubject' => $this->replySubject,
                'replyContent' => $this->replyContent,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
