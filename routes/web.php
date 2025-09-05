<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProfileController;

// ---------------- Home ----------------
Route::get('/', function () {
    return view('welcome');
});

// ---------------- Auth ----------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/signup', [SignupController::class, 'showForm'])->name('register');
Route::post('/signup', [SignupController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ---------------- Profile ----------------
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); // PUT route

// ---------------- Static Pages ----------------
Route::view('/properties', 'pages.properties')->name('properties');
Route::view('/foodplans', 'pages.foodplans')->name('foodplans');
Route::view('/about', 'pages.aboutup')->name('aboutup');

