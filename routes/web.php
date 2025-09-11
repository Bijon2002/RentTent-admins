<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;

// ---------------- Home ----------------
Route::get('/', fn() => view('welcome'))->name('home');

// ---------------- Auth ----------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/signup', [SignupController::class, 'showForm'])->name('register');
Route::post('/signup', [SignupController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ---------------- Profile ----------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// ---------------- Static Pages ----------------
Route::view('/properties', 'pages.properties')->name('properties');
Route::view('/about', 'pages.aboutup')->name('aboutup');

// ---------------- Food Marketplace ----------------
// Public marketplace view
Route::get('/foodplans', [FoodController::class, 'marketplace'])->name('foodplans.index');

// ---------------- Vendor Food Management ----------------
Route::middleware('auth')->prefix('vendor')->group(function () {
    // CRUD for vendor foods
    Route::get('/foods', [FoodController::class, 'index'])->name('vendor.foods');
    Route::get('/foods/create', [FoodController::class, 'create'])->name('vendor.foods.create');
    Route::post('/foods', [FoodController::class, 'store'])->name('vendor.foods.store');
    Route::get('/foods/{id}/edit', [FoodController::class, 'edit'])->name('vendor.foods.edit');
    Route::put('/foods/{id}', [FoodController::class, 'update'])->name('vendor.foods.update');
    Route::delete('/foods/{id}', [FoodController::class, 'destroy'])->name('vendor.foods.destroy');
});

// ---------------- Vendor Details (Public) ----------------
Route::get('/vendor/{id}', [FoodController::class, 'show'])->name('vendor.details');

Route::get('/food-vendors', [FoodController::class, 'index'])->name('food.vendors');

use App\Http\Controllers\SubscriptionController;

Route::post('/vendor/{menu}/subscribe', [SubscriptionController::class, 'subscribe'])
    ->name('subscribe.vendor')
    ->middleware('auth');
