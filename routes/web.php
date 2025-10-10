<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminFoodController;
use App\Http\Controllers\Admin\BoardingListController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Admin\LoginController;

// Redirect root to admin login
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// ====== ADMIN ROUTES ======
Route::prefix('admin')->name('admin.')->group(function () {

    // --- Auth ---
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // --- Dashboard ---
    Route::get('dashboard', function () {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        // Get live data from database
        $totalProperties = \App\Models\Boarding::count();
        $totalUsers = \App\Models\User::count();
        $totalBookings = \App\Models\Booking::count();
        $totalSubscriptions = \App\Models\Subscription::count();
        $totalVendors = \App\Models\FoodMenu::count();
        
        // Additional data for charts
        $approvedProperties = \App\Models\Boarding::where('is_approved', true)->count();
        $verifiedUsers = \App\Models\User::where('verification_status', 'Verified')->count();
        $pendingProperties = $totalProperties - $approvedProperties;
        
        // Calculate monthly revenue from bookings
        $monthlyRevenue = \App\Models\Booking::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');
        
        // Calculate occupancy rate (bookings vs properties)
        $occupancyRate = $totalProperties > 0 ? round(($totalBookings / $totalProperties) * 100, 1) : 0;
        
        // Get recent activities
        $recentBookings = \App\Models\Booking::with(['user', 'boarding'])
            ->latest()
            ->limit(5)
            ->get();
        
        $recentUsers = \App\Models\User::latest()->limit(3)->get();
        
        // Chart data for analytics
        $chartData = [
            'revenue_trend' => [1200, 1900, 3000, 5000, 4000, $monthlyRevenue],
            'user_growth' => [12, 19, 8, floor($totalUsers / 4)],
            'property_status' => [$approvedProperties, $pendingProperties],
            'occupancy_data' => [$totalBookings, $totalProperties - $totalBookings]
        ];
        
        return view('admin.dashboard', compact(
            'totalProperties', 
            'totalUsers', 
            'totalBookings', 
            'totalSubscriptions', 
            'totalVendors',
            'monthlyRevenue',
            'occupancyRate',
            'recentBookings',
            'recentUsers',
            'approvedProperties',
            'verifiedUsers',
            'pendingProperties',
            'chartData'
        ));
    })->name('dashboard');

    // --- Users ---
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');

    // --- Vendors ---
    Route::get('vendors', [AdminFoodController::class, 'index'])->name('vendors');
    Route::get('vendors/create', [AdminFoodController::class, 'create'])->name('vendors.create');
    Route::post('vendors', [AdminFoodController::class, 'store'])->name('vendors.store');
    Route::get('vendors/{id}/edit', [AdminFoodController::class, 'edit'])->name('vendors.edit');
    Route::put('vendors/{id}', [AdminFoodController::class, 'update'])->name('vendors.update');
    Route::post('vendors/{id}/approve', [AdminFoodController::class, 'approve'])->name('vendors.approve');
    Route::delete('vendors/{id}', [AdminFoodController::class, 'destroy'])->name('vendors.destroy');

    // --- Properties ---
    Route::get('properties', [BoardingListController::class, 'index'])->name('properties');
    Route::get('properties/create', [BoardingListController::class, 'create'])->name('properties.create');
    Route::post('properties', [BoardingListController::class, 'store'])->name('properties.store');
    Route::get('properties/{id}/edit', [BoardingListController::class, 'edit'])->name('properties.edit');
    Route::put('properties/{id}', [BoardingListController::class, 'update'])->name('properties.update');
    Route::post('properties/approve/{id}', [BoardingListController::class, 'approve'])->name('properties.approve');
    Route::delete('properties/destroy/{id}', [BoardingListController::class, 'destroy'])->name('properties.destroy');

    // --- Bookings ---
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings');
    Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    // --- Subscriptions ---
    Route::get('subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('subscriptions/create', [AdminSubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('subscriptions', [AdminSubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::get('subscriptions/{id}/edit', [AdminSubscriptionController::class, 'edit'])->name('subscriptions.edit');
    Route::put('subscriptions/{id}', [AdminSubscriptionController::class, 'update'])->name('subscriptions.update');
    Route::delete('subscriptions/{id}', [AdminSubscriptionController::class, 'destroy'])->name('subscriptions.destroy');
});

// ====== OPTIONAL: Front-end subscription routes (if needed) ======
// If you need public-facing subscription functionality, create the controller first
// Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('public.subscriptions.index');
// Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('public.subscriptions.store');
