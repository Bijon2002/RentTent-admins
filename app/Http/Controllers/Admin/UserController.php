<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;

class UserController extends AdminBaseController
{
    private $apiUrl = "http://127.0.0.1:8001/api"; // User project API for images
    private $token  = "1|KM6z0xFl4T2pKGW2sELviH1pJcjUo891i5pQFlnD002a272e";

    // List all users
    public function index()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $users = User::all(); // Direct DB for other data

        // Fetch images from API
        $client = new Client();
        try {
            $response = $client->get("{$this->apiUrl}/users", [
                'headers' => $this->headers()
            ]);
            $apiUsers = json_decode($response->getBody(), true);
            
            // Map images from API to DB users
            foreach ($users as &$user) {
                $apiUser = collect($apiUsers)->firstWhere('user_id', $user->user_id);
                $user->profile_pic_url = $apiUser['profile_pic_url'] ?? asset('img/default-user.png');
                $user->nic_image_url   = $apiUser['nic_image_url'] ?? asset('img/default-nic.png');
            }

        } catch (\Exception $e) {
            session()->flash('error', 'Unable to fetch images: ' . $e->getMessage());
            foreach ($users as &$user) {
                $user->profile_pic_url = asset('img/default-user.png');
                $user->nic_image_url   = asset('img/default-nic.png');
            }
        }

        // Get stats data for the header
        $statsData = $this->getStatsData();

        return view('pages.users', array_merge(compact('users'), $statsData));
    }

    // Verify / Reject user (direct DB)
    public function verify(Request $request, $user_id)
    {
        $request->validate([
            'verification_status' => 'required|in:Pending,Verified,Rejected'
        ]);

        $user = User::find($user_id);
        if (!$user) return back()->with('error', 'User not found');

        $user->verification_status = $request->verification_status;
        $user->save();

        return redirect()->route('admin.users.index')
                         ->with('success', "User verification updated to {$request->verification_status}");
    }

    // Show create user form
    public function create()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $statsData = $this->getStatsData();
        return view('admin.create_user', $statsData);
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'nic_number' => 'required|string|max:20|unique:users,nic_number',
            'location' => 'nullable|string|max:255',
            'role' => 'required|in:finder,provider,vendor',
            'verification_status' => 'required|in:Pending,Verified,Rejected',
            'password' => 'required|string|min:8',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        
        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show edit user form
    public function edit($user_id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $user = User::findOrFail($user_id);
        $statsData = $this->getStatsData();
        return view('admin.edit_user', array_merge(compact('user'), $statsData));
    }

    // Update user
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user_id . ',user_id',
            'phone' => 'required|string|max:20',
            'nic_number' => 'required|string|max:20|unique:users,nic_number,' . $user_id . ',user_id',
            'location' => 'nullable|string|max:255',
            'role' => 'required|in:finder,provider,vendor',
            'verification_status' => 'required|in:Pending,Verified,Rejected',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete user (direct DB)
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        if (!$user) return back()->with('error', 'User not found');

        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'User deleted successfully');
    }

    // Common headers for API
    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];
    }
}
