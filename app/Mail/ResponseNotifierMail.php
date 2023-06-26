<?php

declare(strict_types = 1);

namespace App\Mail;

use App\Models\Response;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResponseNotifierMail extends Mailable
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
    public function __construct(protected User $user, protected Response $response)
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
            subject: 'Response notification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return $this
     */
    public function build()
{
    $this->user->email;

    return $this->markdown('emails.responseNotification')
        ->subject('Response notification')
        ->with([
            'name' => $this->user->name,
            'content' => $this->response->content
        ]);
    }
}
