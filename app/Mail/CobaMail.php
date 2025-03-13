<?php

namespace App\Mail;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;

class CobaMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;

    /**
     * Create a new message instance.
     */
    public function __construct(
        $user
    ) {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('kiki@gmail.com', 'kiki'),
            replyTo: [
                new Address('kocakgaming@gmail.com', 'Kocak Gaming'),
            ],
            subject: 'Coba Mail',
        );
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        return new Content(
            view: 'mail.welcome',
            with: [
                'userEmail' => $this->user['email'],
                'userName' => $this->user['name'],
            ]
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attachment::fromStorageDisk('public', 'images/1741679785.png')
        ];
    }
}
