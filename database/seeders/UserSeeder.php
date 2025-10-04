<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Vendor One',
                'email' => 'vendor1@example.com',
                'phone' => '0771234567',
                'nic_number' => '123456789V',
                'role' => 'vendor',
                'profile_pic' => null,
                'location' => 'Colombo',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Provider One',
                'email' => 'provider1@example.com',
                'phone' => '0779876543',
                'nic_number' => '987654321V',
                'role' => 'provider',
                'profile_pic' => null,
                'location' => 'Colombo',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
