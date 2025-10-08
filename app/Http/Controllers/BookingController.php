<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
use App\Models\Boarding;
use App\Mail\BookingNotification;

class BookingController extends Controller
{
    // Reserve a boarding
    public function reserve(Request $request, $boarding_id)
    {
        return $this->handleBooking($request, $boarding_id, 'reserved');
    }

    // Book a boarding
    public function book(Request $request, $boarding_id)
    {
        return $this->handleBooking($request, $boarding_id, 'booked');
    }

    // Common handler
    private function handleBooking(Request $request, $boarding_id, $status)
    {
        $user = Auth::user();

        // Load boarding with provider
        $boarding = Boarding::with('provider')->findOrFail($boarding_id);

        if($request->confirmed ?? true){

            // Calculate amount
            $amount = $status === 'reserved' ? $boarding->monthly_rent * 0.1 : $boarding->monthly_rent * 0.4;

            // Create booking
            $booking = Booking::create([
                'user_id' => $user->user_id,
                'boarding_id' => $boarding->boarding_id,
                'amount' => $amount,
                'status' => $status,
                'reserved_at' => $status === 'reserved' ? now() : null,
                'booked_at' => $status === 'booked' ? now() : null,
                'is_non_refundable' => true,
            ]);

            // Increase trust score if booked
            if($status === 'booked') {
                $boarding->trust_score += 1;
                $boarding->save();
            }

            // Send emails
            Mail::to($user->email)->send(new BookingNotification($booking, 'user'));
            Mail::to($boarding->provider->email)->send(new BookingNotification($booking, 'provider'));

            return redirect()->back()->with('success', ucfirst($status) . ' successful!');
        }

        return redirect()->back();
    }

    // Optional: Book Now page (GET)
    public function bookNow($boarding_id)
    {
        $boarding = Boarding::with('provider')->findOrFail($boarding_id);
        return view('booking.book', compact('boarding'));
    }
}
