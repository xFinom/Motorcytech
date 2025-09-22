<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceOrdersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Inertia\Inertia;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\WorkerlistController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return Inertia::render('Landing/LandingPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

//Route::get('/dashboard', [ServiceOrdersController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/service/order', [ServiceOrdersController::class, 'index'])->middleware(['auth', 'verified'])->name('service.order.index');
Route::get('/dashboard/service/order/create', [ServiceOrdersController::class, 'create'])->middleware(['auth', 'verified'])->name('service.order.create');
Route::post('/dashboard/service/order', [ServiceOrdersController::class, 'store'])->middleware(['auth', 'verified'])->name('service.order.store');


Route::get('/dashboard/userslist', [UserListController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('userslist');

Route::put('/users/{user}', [UserListController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserListController::class, 'destroy'])->name('users.destroy');

// Trabajadores
Route::get('/dashboard/workerslist', [WorkerlistController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('workerslist');

Route::put('/workers/{worker}', [WorkerlistController::class, 'update'])->name('workers.update');
Route::delete('/workers/{worker}', [WorkerlistController::class, 'destroy'])->name('workers.destroy');

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
