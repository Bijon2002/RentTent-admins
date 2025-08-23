<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SignupController extends Controller
{
    public function showForm()
    {
        return view('auth.signup');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'nic_number' => 'required|string|max:50',
            'role' => 'required|in:finder,provider,vendor',
            'profile_pic' => 'nullable|image|max:2048',
            'location' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'nic_number' => $validated['nic_number'],
            'role' => $validated['role'],
            'profile_pic' => $profilePicPath,
            'location' => $validated['location'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', 'Account created! Please login.');
    }
}
