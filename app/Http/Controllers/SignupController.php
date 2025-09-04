<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|string|max:20',
            'nic_number'=>'required|string|max:50',
            'role'=>'required|in:finder,provider,vendor',
            'profile_pic'=>'nullable|image|max:2048',
            'nic_image'=>'nullable|image|max:2048',
            'location'=>'required|string|max:255',
            'password'=>'required|string|min:6|confirmed', // double password field
        ]);

        $profilePicPath = $request->hasFile('profile_pic') ? $request->file('profile_pic')->store('profile_pics','public') : null;
        $nicImagePath = $request->hasFile('nic_image') ? $request->file('nic_image')->store('nic_images','public') : null;

        $user = User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'phone'=>$validated['phone'],
            'nic_number'=>$validated['nic_number'],
            'role'=>$validated['role'],
            'profile_pic'=>$profilePicPath,
            'nic_image'=>$nicImagePath,
            'location'=>$validated['location'],
            'password'=>Hash::make($validated['password']),
            'verification_status'=>'Pending',
        ]);

    // store user id in session
    session(['user_id'=>$user->id]);

        return redirect()->route('login')->with('success','Account created! Please login.');
    }
}
