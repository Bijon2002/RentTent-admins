<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::all()->map(function($user) {
            return [
                'user_id' => $user->user_id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'nic_number' => $user->nic_number,
                'role' => $user->role,
                'verification_status' => $user->verification_status,
                'location' => $user->location,
                'profile_pic_url' => url('storage/' . $user->profile_pic),
                'nic_image_url' => url('storage/' . $user->nic_image),
            ];
        });

        return response()->json($users);
    }

    // Show single user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'user_id' => $user->user_id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'nic_number' => $user->nic_number,
            'role' => $user->role,
            'verification_status' => $user->verification_status,
            'location' => $user->location,
            'profile_pic_url' => url('storage/' . $user->profile_pic),
            'nic_image_url' => url('storage/' . $user->nic_image),
        ]);
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only([
            'name', 'email', 'phone', 'nic_number', 'role', 'location', 'verification_status'
        ]));
        return response()->json(['message' => 'User updated successfully']);
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
