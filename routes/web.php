<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BoardingListController;
use App\Http\Controllers\Admin\RoomPhotoController;
use App\Http\Controllers\Admin\FoodMenuController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\ChatbotController;
use App\Http\Controllers\Admin\LoginController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('dashboard', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login');
    }
    return view('admin.dashboard');
})->name('dashboard');
});
Route::get('/properties', function () {
    $properties = [
        (object)['id'=>1, 'title'=>'Koramangala Premium', 'status'=>'approved'],
        (object)['id'=>2, 'title'=>'HSR Layout Studio', 'status'=>'pending'],
    ];
    return view('pages.properties', compact('properties'));
})->name('properties');
Route::get('/vendors', function () {
    $vendors = [
        (object)['id'=>1, 'name'=>'Vendor A', 'email'=>'vendorA@example.com', 'status'=>'active'],
        (object)['id'=>2, 'name'=>'Vendor B', 'email'=>'vendorB@example.com', 'status'=>'pending'],
    ];
    return view('pages.vendors', compact('vendors'));
})->name('vendors');
Route::get('/users', function () {
    $users = [
        (object)['id'=>1, 'name'=>'John Doe', 'email'=>'john@example.com', 'role'=>'admin', 'status'=>'active'],
        (object)['id'=>2, 'name'=>'Jane Smith', 'email'=>'jane@example.com', 'role'=>'user', 'status'=>'inactive'],
    ];
    return view('pages.users', compact('users'));
})->name('users');
Route::get('/bookings', function () {
    $bookings = [
        (object)[
          'id' => 1,
          'property' => 'Koramangala Premium',
          'user' => 'Priya Sharma',
          'date' => '2025-08-05',
          'status' => 'confirmed'
        ],
        (object)[
          'id' => 2,
          'property' => 'HSR Layout Studio',
          'user' => 'Arjun Patel',
          'date' => '2025-08-07',
          'status' => 'pending'
        ],
    ];
    return view('pages.bookings', compact('bookings'));
})->name('bookings');
