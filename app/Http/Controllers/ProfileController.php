<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        // Only display current user details
        return view('pages.profile');
    }

    public function edit(Request $request)
    {
        // Return a basic edit profile view (to be created)
        return view('pages.edit_profile');
    }

    public function update(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nic_number' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

    // Get current user (assuming session stores user_id)
    $user = \App\Models\User::where('user_id', session('user.user_id'))->first();
        if ($user) {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->nic_number = $validated['nic_number'] ?? $user->nic_number;
            $user->location = $validated['location'] ?? $user->location;
            $user->save();

            // Always reload user from DB and update session
            $freshUser = \App\Models\User::where('user_id', $user->user_id)->first();
            session(['user' => $freshUser ? $freshUser->toArray() : $user->toArray()]);
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
