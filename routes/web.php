<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminFoodController;
use App\Http\Controllers\Admin\BoardingListController;
use App\Http\Controllers\Admin\LoginController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::prefix('admin')->name('admin.')->group(function () {

    // Auth
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

    // Pages
    Route::get('properties', function () { return view('pages.properties'); })->name('properties');
    Route::get('vendors', function () { return view('pages.vendors'); })->name('vendors');
    Route::get('bookings', function () { return view('pages.bookings'); })->name('bookings');

    // Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');

    // Vendors (dynamic, using controller)
    Route::get('vendors', [AdminFoodController::class, 'index'])->name('vendors');
    Route::post('vendors/{id}/approve', [AdminFoodController::class, 'approve'])->name('vendors.approve');
    Route::delete('vendors/{id}', [AdminFoodController::class, 'destroy'])->name('vendors.destroy');

    //properties
    Route::get('/properties', [BoardingListController::class, 'index'])->name('properties');
    Route::post('/properties/approve/{id}', [BoardingListController::class, 'approve'])->name('properties.approve');
    Route::delete('/properties/destroy/{id}', [BoardingListController::class, 'destroy'])->name('properties.destroy');
});

