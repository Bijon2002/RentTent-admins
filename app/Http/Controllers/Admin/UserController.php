<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Show form to create new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6',
            'role'       => 'required|in:finder,provider,vendor',
            'nic_number' => 'required|unique:users,nic_number',
            // Add more validation as needed
        ]);

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => bcrypt($request->password),
            'role'        => $request->role,
            'nic_number'  => $request->nic_number,
            'phone'       => $request->phone,
            'profile_pic' => $request->profile_pic,
            'location'    => $request->location,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created');
    }

    // Show single user
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Show edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'       => 'required',
            'email'      => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'role'       => 'required|in:finder,provider,vendor',
            'nic_number' => 'required|unique:users,nic_number,' . $user->user_id . ',user_id',
            'password'   => 'nullable|min:6',
        ]);

        $data = $request->only('name', 'email', 'phone', 'location', 'role', 'nic_number', 'profile_pic');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted');
    }
}
