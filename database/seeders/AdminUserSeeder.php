<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user with ID 1
        User::updateOrCreate(
            ['user_id' => 1],
            [
                'name' => 'Admin User',
                'email' => 'admin@renttent.com',
                'phone' => '0000000000',
                'nic_number' => 'ADMIN001',
                'location' => 'Admin Location',
                'role' => 'provider',
                'verification_status' => 'Verified',
                'password' => bcrypt('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
