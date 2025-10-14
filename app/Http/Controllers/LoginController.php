<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login page
    public function showLoginForm()
    {
        return view('auth.login'); // Make sure this Blade file exists
    }

    // Handle login form submission
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // updates session for navbar
            // Store user in session for navbar
            $user = Auth::user();
            $request->session()->put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile_pic' => $user->profile_pic ?? null,
            ]);
            return redirect('/'); // redirect to home page
        }

        // Login failed → redirect back with popup error
        return back()->with('login_error', 'Invalid email or password')->withInput();
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user'); // Remove user from session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}


