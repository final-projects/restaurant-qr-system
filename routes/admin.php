<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| All admin routes are prefixed with /admin and use "admin." name prefix.
|--------------------------------------------------------------------------
*/

// 🔓 Public admin routes (no login required)
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

// 🔐 Protected routes (requires admin middleware)
Route::middleware('admin')->group(function () {

    // 📊 Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // 📦 Orders - full resource
    Route::resource('orders', OrderController::class)->names('orders');

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
