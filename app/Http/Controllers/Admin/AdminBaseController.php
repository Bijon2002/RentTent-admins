<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Boarding;
use App\Models\User;
use App\Models\FoodMenu;
use App\Models\Vendor;

class AdminBaseController extends Controller
{
    protected function getStatsData()
    {
        // Get live data from database
        $totalProperties = Boarding::count();
        $totalUsers = User::count();
        $totalBookings = Booking::count();
        $totalVendors = FoodMenu::count();
        
        // Additional data for charts
        $approvedProperties = Boarding::where('is_approved', true)->count();
        $verifiedUsers = User::where('verification_status', 'Verified')->count();
        
        // Calculate monthly revenue from bookings
        $monthlyRevenue = Booking::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');
        
        // Calculate occupancy rate (bookings vs properties)
        $occupancyRate = $totalProperties > 0 ? round(($totalBookings / $totalProperties) * 100, 1) : 0;
        
        return compact(
            'totalProperties', 
            'totalUsers', 
            'totalBookings', 
            'totalVendors',
            'monthlyRevenue',
            'occupancyRate',
            'approvedProperties',
            'verifiedUsers'
        );
    }

    protected function checkAdminAuth()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }
}