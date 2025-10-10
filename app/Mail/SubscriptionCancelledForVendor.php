<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscription; // ✅ import the model, not the mail class
use App\Models\User;

class SubscriptionCancelledForVendor extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription;
    public $user;
    public $reason;

    public function __construct(Subscription $subscription, User $user, string $reason)
    {
        $this->subscription = $subscription;
        $this->user = $user;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('A User Has Cancelled Their Subscription')
                    ->markdown('emails.vendor.cancellation');
    }
}
