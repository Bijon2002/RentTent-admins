<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class BookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $type;

    public function __construct(Booking $booking, $type = 'user')
    {
        $this->booking = $booking;
        $this->type = $type;
    }

    public function build()
    {
        if($this->type === 'user') {
            return $this->subject('Booking Notification')
                        ->view('emails.booking_user');
        } else {
            return $this->subject('Booking Notification')
                        ->view('emails.booking_provider');
        }
    }
}
