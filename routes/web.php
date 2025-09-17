<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Inertia\Inertia;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return Inertia::render('Landing/LandingPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/ServiceOrders/CreateServiceOrder');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard/userslist', [UserListController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('userslist');

Route::get('/dashboard/motorcycleslist', [MotorcycleController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('motorcycleslist');

Route::get('/dashboard/supplierslist', [SupplierController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('supplierslist');
Route::delete('/dashboard/suppliers/{supplier}', [SupplierController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('suppliers.destroy');
Route::put('/dashboard/suppliers/{supplier}', [SupplierController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('suppliers.update');       
Route::post('/dashboard/suppliers', [SupplierController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('suppliers.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';
