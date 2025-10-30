<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\PrivateMessagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ServiceOrdersController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\WorkerlistController;
use App\Http\Controllers\PurchaseOrderItemController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/purchase-orders', [PurchaseOrderItemController::class, 'index'])
        ->name('purchase_orders.index');
});

Route::get('/', function () {
    return Inertia::render('Landing/LandingPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');

Route::get('/service-orders/{serviceOrder:id}', [ServiceOrdersController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('service-orders.show');
Route::patch('/service-orders/{serviceOrder}/status', [ServiceOrdersController::class, 'updateStatus'])
    ->name('service-orders.update-status');

Route::post('/service/order/message', [PrivateMessagesController::class, 'store'])->name('service.order.message.store');

Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews.index');

Route::middleware(['auth', 'verified'])->group(function () {
    // Mostrar formulario
    Route::get('/ReviewsForm', function () {
        return Inertia::render('Dashboard/Reviews/ReviewsForm');
    })->name('reviews.form');

    // Guardar review
    Route::post('/reviews', [ReviewsController::class, 'store'])->name('reviews.store');
});

Route::get('/Validreviews', [ReviewsController::class, 'validreview'])->name('reviews.validreview');

Route::put('/reviews/{review}/validate', [ReviewsController::class, 'validateReview'])
    ->middleware(['auth', 'verified'])
    ->name('reviews.validate');

Route::delete('/reviews/{review}', [ReviewsController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('reviews.destroy');

Route::get('/AboutUs', function () {
    return Inertia::render('Landing/About/AboutUs');
})->name('aboutUs');

Route::get('/dashboard', function () {
    $totalServiceOrders = \App\Models\ServiceOrders::query()->count();
    $totalClients = \App\Models\User::query()->count();
    $totalMotorcycles = \App\Models\ServiceOrders::query()->where('service_orders.status', '!=', \App\Enums\ServiceOrderStatus::Finalizado)->count();
    $totalPendingReviews = \App\Models\Reviews::query()->where('reviews.status', \App\Enums\ReviewStatus::Pendiente)->count();

    $chartData = \App\Models\ServiceOrders::query()
        ->selectRaw('service_id, COUNT(*) as total')
        ->with('service:id,name') // solo carga lo necesario
        ->groupBy('service_id')
        ->get()
        ->map(fn ($order) => [
            'name' => $order->service->name,
            'total' => $order->total,
        ]);
    $recentClients = \App\Models\User::query()->where('users.role', \App\Enums\UserRole::Cliente)->latest()->take(7)->get();

    return Inertia::render('Dashboard/Overview/Overview', [
        'totalServiceOrders' => $totalServiceOrders,
        'totalClients' => $totalClients,
        'totalMotorcycles' => $totalMotorcycles,
        'totalPendingReviews' => $totalPendingReviews,
        'chartData' => $chartData,
        'recentClients' => $recentClients,
    ]);
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
