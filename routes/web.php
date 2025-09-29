<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceOrdersController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\WorkerlistController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Landing/LandingPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/service-orders/{serviceOrder:id}', [ServiceOrdersController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('service-orders.show');
Route::patch('/service-orders/{serviceOrder}/status', [ServiceOrdersController::class, 'updateStatus'])
    ->name('service-orders.update-status');



    
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/ServiceOrders/CreateServiceOrder');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::prefix('workers')->name('workers.')->group(function () {
    Route::post('/', [WorkerlistController::class, 'store'])->name('store');
    Route::put('/{worker}', [WorkerlistController::class, 'update'])->name('update');
    Route::delete('/{worker}', [WorkerlistController::class, 'destroy'])->name('destroy');
});

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
