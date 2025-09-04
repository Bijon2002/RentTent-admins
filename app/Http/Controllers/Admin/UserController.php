<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{
    /**
     * Display all users via API from the users project.
     */
    public function index()
    {
        $token = "1|KM6z0xFl4T2pKGW2sELviH1pJcjUo891i5pQFlnD002a272e"; // Sanctum token from users project
        $client = new Client();

        try {
            $response = $client->get('http://127.0.0.1:8001/api/users', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ]
            ]);

            $users = json_decode($response->getBody(), true);

            // Fallback for missing images
            foreach($users as &$user) {
                $user['profile_pic_url'] = $user['profile_pic_url'] ?? 'https://via.placeholder.com/150';
                $user['nic_image_url'] = $user['nic_image_url'] ?? 'https://via.placeholder.com/250x150';
            }

        } catch (\Exception $e) {
            $users = [];
            session()->flash('error', 'Unable to fetch users from API: ' . $e->getMessage());
        }

        return view('pages.users', compact('users'));
    }

    /**
     * Update a user's details via users project API.
     */
    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'nic_number' => 'required|string|max:50',
            'role' => 'required|in:finder,provider,vendor',
            'location' => 'required|string|max:255',
            'verification_status' => 'required|in:Pending,Verified,Manual Review,Rejected',
        ]);

        $token = "1|KM6z0xFl4T2pKGW2sELviH1pJcjUo891i5pQFlnD002a272e";
        $client = new Client();
        $client->patch("http://127.0.0.1:8001/api/user/{$user_id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
            'form_params' => $request->only([
                'name', 'email', 'phone', 'nic_number', 'role', 'location', 'verification_status'
            ])
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User updated successfully via API');
    }

    /**
     * Delete a user via users project API.
     */
    public function destroy($user_id)
    {
        $token = "1|KM6z0xFl4T2pKGW2sELviH1pJcjUo891i5pQFlnD002a272e";
        $client = new Client();

        try {
            $client->delete("http://127.0.0.1:8001/api/user/{$user_id}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ]
            ]);
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete user via API: ' . $e->getMessage());
        }

        return redirect()->route('admin.users.index')
                         ->with('success', 'User deleted successfully via API');
    }
}
