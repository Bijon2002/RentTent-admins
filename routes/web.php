<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // needed for Auth::check()
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProfileController;

// ---------------- Home ----------------
Route::get('/', function () {
    return view('welcome');
});

// ---------------- Auth ----------------
// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Signup / Register
Route::get('/signup', [SignupController::class, 'showForm'])->name('register');
Route::post('/signup', [SignupController::class, 'register'])->name('register.post');

// Logout (POST only)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Profile page
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// ---------------- Static Pages ----------------
Route::view('/properties', 'pages.properties')->name('properties');
Route::view('/foodplans', 'pages.foodplans')->name('foodplans');
Route::view('/about', 'pages.aboutup')->name('aboutup');

// ---------------- Test Session ----------------
Route::get('/test-session', function() {
    return Auth::check() ? Auth::user() : 'No user logged in';
});
