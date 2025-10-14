<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends AdminBaseController
{
    public function index()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $subscriptions = Subscription::with(['user', 'vendor'])->get();
        $statsData = $this->getStatsData();
        return view('pages.bookings', array_merge(compact('subscriptions'), $statsData));
        // same view as bookings for combined display
    }

    // Show create subscription form
    public function create()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $users = \App\Models\User::all();
        $vendors = \App\Models\FoodMenu::all();
        $statsData = $this->getStatsData();
        return view('admin.create_subscription', array_merge(compact('users', 'vendors'), $statsData));
    }

    // Store new subscription
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'vendor_id' => 'required|exists:food_menu,menu_id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive,cancelled',
        ]);

        $data = $request->all();
        
        // If no user_id provided, set to default admin user (001)
        if (empty($data['user_id'])) {
            $data['user_id'] = 1; // Default admin user ID
        }
        
        // If no vendor_id provided, set to default admin vendor (001)
        if (empty($data['vendor_id'])) {
            $data['vendor_id'] = 1; // Default admin vendor ID
        }

        Subscription::create($data);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription created successfully.');
    }

    // Show edit subscription form
    public function edit($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $subscription = Subscription::with(['user', 'vendor'])->findOrFail($id);
        $users = \App\Models\User::all();
        $vendors = \App\Models\FoodMenu::all();
        $statsData = $this->getStatsData();
        return view('admin.edit_subscription', array_merge(compact('subscription', 'users', 'vendors'), $statsData));
    }

    // Update subscription
    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'vendor_id' => 'required|exists:food_menu,menu_id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive,cancelled',
        ]);

        $subscription->update($request->all());

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index')
                         ->with('success', 'Subscription deleted successfully.');
    }
}
