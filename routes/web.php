

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;

// Root redirects to admin login
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Admin routes group
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('dashboard', function () {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return view('admin.dashboard');
    })->name('dashboard');

    // Properties page route
    Route::get('properties', function () {
        $properties = [
            (object)[ 'id' => 1, 'title' => 'Sample Property 1', 'status' => 'active' ],
            (object)[ 'id' => 2, 'title' => 'Sample Property 2', 'status' => 'inactive' ],
        ];
        return view('pages.properties', compact('properties'));
    })->name('properties');

            Route::get('vendors', function () {
            return view('pages.vendors');
        })->name('vendors');

        //booking
        Route::get('bookings', function () {
            return view('pages.bookings');
        })->name('bookings');


    // Users CRUD (full resource routes)
    Route::resource('users', UserController::class);
});
