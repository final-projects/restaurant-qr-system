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
|
| This file contains all the admin-related routes.
| Routes are grouped with the "admin." name prefix and "/admin" URI prefix.
|
*/

// Public admin routes (no authentication required)
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

// Protected admin routes (requires admin authentication)
Route::middleware('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');

    Route::resource('categories', CategoryController::class);

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    // Add more protected admin routes below...
});

