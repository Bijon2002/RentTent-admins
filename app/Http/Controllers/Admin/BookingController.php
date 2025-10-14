<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Subscription;

class BookingController extends AdminBaseController
{
    // Show both bookings & subscriptions
    public function index()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $bookings = Booking::with(['user', 'boarding'])->get();
        $subscriptions = Subscription::with(['user', 'vendor'])->get();
        $statsData = $this->getStatsData();

        return view('pages.bookings', array_merge(compact('bookings', 'subscriptions'), $statsData));
    }

    // Show create booking form
    public function create()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $users = \App\Models\User::all();
        $boardings = \App\Models\Boarding::all();
        $statsData = $this->getStatsData();
        return view('admin.create_booking', array_merge(compact('users', 'boardings'), $statsData));
    }

    // Store new booking
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'boarding_id' => 'required|exists:boarding_list,boarding_id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'reserved_at' => 'required|date|nullable',
            'booked_at' => 'required|date|nullable',
        ]);

        $data = $request->all();
        
        // If no user_id provided, set to default admin user (001)
        if (empty($data['user_id'])) {
            $data['user_id'] = 1; // Default admin user ID
        }

        Booking::create($data);

        return redirect()->route('admin.bookings')->with('success', 'Booking created successfully.');
    }

    // Edit booking
    public function edit($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $booking = Booking::with(['user', 'boarding'])->findOrFail($id);
        $statsData = $this->getStatsData();
        return view('pages.edit_booking', array_merge(compact('booking'), $statsData));
    }

    // Update booking
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        // ✅ Redirect to index, which passes both tables
        return redirect()->route('admin.bookings')->with('success', 'Booking updated successfully.');
    }

    // Delete booking
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        // ✅ Redirect to index, not to a view directly!
        return redirect()->route('admin.bookings')->with('success', 'Booking deleted successfully.');
    }

    // Delete subscription
    public function destroySubscription($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('admin.bookings')->with('success', 'Subscription deleted successfully.');
    }
}
