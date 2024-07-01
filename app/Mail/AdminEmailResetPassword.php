<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class AdminEmailResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private $token)
    {
        //
    }

    public function envelope()
    {
        return new Envelope(
            from: new Address('example@example.com', 'Reset Password'),
            subject: 'Reset Password',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.adminResetPasswordEmail',
            with: ['token' => $this->token],
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
