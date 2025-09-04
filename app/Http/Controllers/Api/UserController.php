<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->map(fn($u) => [
            'user_id' => $u->user_id,
            'name' => $u->name,
            'email' => $u->email,
            'phone' => $u->phone,
            'nic_number' => $u->nic_number,
            'role' => $u->role,
            'verification_status' => $u->verification_status,
            'location' => $u->location,
            'profile_pic_url' => url('storage/' . $u->profile_pic),
            'nic_image_url' => url('storage/' . $u->nic_image),
        ]);

        return response()->json($users);
    }
}
