<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user(); // 🔥 Use Laravel Auth

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }
