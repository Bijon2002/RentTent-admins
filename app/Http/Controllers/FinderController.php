<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionCancelledForUser;
use App\Mail\SubscriptionCancelledForVendor;

class FinderController extends Controller
{
    // Show all booked boardings
    public function bookedBoardings() {
        $bookings = Booking::where('user_id', Auth::user()->user_id) // ✅ fixed
                           ->with('boarding')
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('finder.booked_boardings', compact('bookings'));
    }

    // Show all subscribed foods
    public function subscribedFoods() {
        $userId = Auth::user()->user_id; // ✅ fixed

        $subscriptions = Subscription::where('user_id', $userId)
                                     ->with('vendor')
                                     ->orderBy('created_at', 'desc')
                                     ->get();

        return view('finder.subscribed_foods', compact('subscriptions'));
    }

    // Cancel subscription
    public function cancelSubscription(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        // ✅ Compare with user_id, not Auth::id()
        if ($subscription->user_id !== Auth::user()->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $reason = $request->input('cancellation_reason');
        $otherReason = $request->input('other_reason_details');
        $fullReason = $reason === 'other' ? $otherReason : $reason;

        // ✅ Get user and vendor
        $user = Auth::user();
        $vendor = $subscription->vendor->user;

        // Send emails
        Mail::to($user->email)->send(new SubscriptionCancelledForUser($subscription, $fullReason));
        Mail::to($vendor->email)->send(new SubscriptionCancelledForVendor($subscription, $user, $fullReason));

        // ✅ Update status
        $subscription->status = 'cancelled';
        $subscription->save();

        return redirect()->back()->with('success', 'Subscription cancelled successfully!');
    }
}
