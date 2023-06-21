<?php

declare(strict_types = 1);

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param User   $user the user
     * @param string $url  the reset link
     *
     * @return void
     */
    public function __construct(public string $url, public User $user)
    {
    }

        /**
         * Get the message envelope.
         *
         * @return \Illuminate\Mail\Mailables\Envelope
         */
    public function envelope()
    {
        return new Envelope(
            to: [new Address($this->user->email, $this->user->name)],
            subject: 'Password reset notification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return $this
     */
    public function build()
{
    $resetUrl = 'http://localhost:8000/reset-password/'.$this->url.'/'.$this->user->email;

    return $this->markdown('emails.resetEmail')
        ->subject('Password reset notification')
        ->with([
            'name' => $this->user->name,
            'resetUrl' => $resetUrl,
        ]);
    }
}
