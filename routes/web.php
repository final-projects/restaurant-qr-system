<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicMenuController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\OrderController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

    Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
        Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('menus', [\App\Http\Controllers\User\MenuController::class, 'index'])->name('menus.index');

    });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/orders/{id}', [AdminController::class, 'view'])->name('admin.view');
    Route::post('/admin/orders/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.status');
    Route::delete('/admin/orders/{id}', [AdminController::class, 'delete'])->name('admin.delete');
});


Route::get('/menu', [PublicMenuController::class, 'index'])->name('menu.public.index');

Route::get('/orders/menu/{table}', [PublicMenuController::class, 'menu'])->name('show.public.menu');

Route::post('/orders/submit/{table}/{menu}', [PublicMenuController::class, 'submit'])->name('submit.public.menu');

require __DIR__.'/auth.php';
