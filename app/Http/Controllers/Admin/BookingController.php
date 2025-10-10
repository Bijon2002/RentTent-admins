<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Fetch bookings with related user and boarding data
        $bookings = Booking::with(['user', 'boarding'])->get();

        return view('pages.bookings', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = Booking::with(['user', 'boarding'])->findOrFail($id);
        return view('pages.edit_booking', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('admin.bookings')->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings')->with('success', 'Booking deleted successfully.');
    }
}
