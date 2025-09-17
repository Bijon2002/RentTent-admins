<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $reason;

    public function __construct($status, $reason = null)
    {
        $this->status = $status;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject("Profile Verification {$this->status}")
                    ->view('emails.verification_status');
    }
}
