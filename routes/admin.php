<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| All admin routes are prefixed with /admin and use "admin." name prefix.
|--------------------------------------------------------------------------
*/

// 🔓 Public admin routes (no login required)
Route::middleware('guest.admin')->group(function () {
    // 📜 Admin login form
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');

    // 🔑 Admin login action
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
});


Route::get('/tables/{table}/qr', function (\App\Models\Table $table) {
    
    $qr = QrCode::format('png')->size(200)->generate(url('/table/' . $table->qr_token));
    return Response::make($qr, 200, ['Content-Type' => 'image/png']);
})->name('tables.qr');
// 🔐 Protected routes (requires admin middleware)
Route::middleware('auth:admin')->group(function () {


    // 📊 Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // 📦 Orders - full resource
    // Route::resource('orders', OrderController::class)->names('orders');
    Route::resource('orderss', OrderController::class)->names('orders');

    // 🍽️ Tables
    Route::resource('tables', TableController::class)->names('tables');

    // 📋 Menus
    Route::resource('menus', MenuController::class)->names('menus');

    // 🗂️ Categories
    Route::resource('categories', CategoryController::class)->names('categories');

    // ⚙️ Settings (only index for now)
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    // 🚪 Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
