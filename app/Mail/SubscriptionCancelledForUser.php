<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscription;

class SubscriptionCancelledForUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
public function __construct(public Subscription $subscription, public string $reason)


{
    // The 'public' keyword automatically makes these variables available in your email view
}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscription Cancelled For User',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.user.cancellation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
    public function build()
{
    return $this->subject('Your Subscription Has Been Cancelled')
                ->markdown('emails.user.cancellation');
}
}
