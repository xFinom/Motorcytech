<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardOverviewController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ItemSetsController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\PrivateMessagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ServiceForecastController;
use App\Http\Controllers\ServiceOrderBillController;
use App\Http\Controllers\ServiceOrderPaymentController;
use App\Http\Controllers\ServiceOrdersController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TermsAndConditionsController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\WorkerlistController;
use App\Http\Controllers\PurchaseOrderItemController;
use App\Http\Controllers\StoreItemsController;
use App\Http\Controllers\ServiceOrderSparePartController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', HomepageController::class)->name('home');
Route::get('/about', AboutUsController::class)->name('about');
Route::get('/terms', TermsAndConditionsController::class) ->name('terms');
Route::get('/privacy', PrivacyPolicyController::class)->name('privacy');
Route::get('/shop', [StoreItemsController::class, 'index'])->name('shop.index');

Route::prefix('reviews')->as('reviews.')->group(function () {
    Route::get('/', [ReviewsController::class, 'index'])->name('index');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/create', [ReviewsController::class, 'create'])->name('reviews.form');
        Route::post('/', [ReviewsController::class, 'store'])->name('reviews.store');
    });
});

Route::post('/service-orders/tracking', [ServiceOrdersController::class, 'tracking'])->name('service-orders.tracking');

Route::prefix('service-orders')
    ->as('service.orders.')
    ->middleware(['auth', 'role:Admin,Trabajador'])
    ->group(function () {
        Route::get('/{serviceOrder:id}', [ServiceOrdersController::class, 'show'])->name('show');
        Route::patch('/{serviceOrder}/status', [ServiceOrdersController::class, 'updateStatus'])->name('update-status');
        Route::post('/message', [PrivateMessagesController::class, 'store'])->name('message.store');
    });

Route::prefix('dashboard')
    ->middleware(['auth', 'verified', 'role:Admin,Trabajador'])
    ->as('dashboard.')
    ->group(function () {
        Route::get('/', DashboardOverviewController::class)->name('overview');
        Route::get('/forecast', ServiceForecastController::class)->name('forecast');
        Route::get('/itemsets', ItemSetsController::class)->name('itemsets');

        Route::prefix('purchase-orders')->as('purchase.orders.')->group(function () {
            Route::get('/', [PurchaseOrderItemController::class, 'index'])->name('index');
        });

        Route::prefix('motorcycles')->as('motorcycles.')->group(function () {
            Route::get('/', [MotorcycleController::class, 'index'])->name('index');
        });

        Route::prefix('store/items')->as('store.items.')->group(function () {
            Route::get('/', [StoreItemsController::class, 'indexDasboard'])->name('index');
        });

        Route::prefix('bills')->as('bills.')->group(function () {
           Route::get('/create', [ServiceOrderBillController::class, 'create'])->name('create');
           Route::post('/', [ServiceOrderBillController::class, 'store'])->name('store');
           Route::put('/{serviceOrderBill}', [ServiceOrderBillController::class, 'update'])->name('update');
        });

        Route::prefix('clients')->as('client.')->group(function () {
            Route::get('/historic', [UserListController::class, 'index'])->name('historic');
            Route::put('/{user}', [UserListController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserListController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('reviews')->as('reviews.')->group(function () {
            Route::get('/', [ReviewsController::class, 'validreview'])->name('index');
            Route::get('/historic', [ReviewsController::class, 'historic'])->name('historic');
            Route::put('/{review}/validate', [ReviewsController::class, 'validateReview'])->name('reviews.validate');
            Route::delete('/{review}', [ReviewsController::class, 'destroy'])->name('reviews.destroy');
        });

        Route::prefix('service-orders')->as('service.orders.')->group(function () {
            Route::get('/', [ServiceOrdersController::class, 'index'])->name('index');
            Route::get('/historic', [ServiceOrdersController::class, 'historic'])->name('historic');
            Route::get('/create', [ServiceOrdersController::class, 'create'])->name('create');
            Route::post('/', [ServiceOrdersController::class, 'store'])->name('store');

            Route::prefix('spare-parts')->as('spare.parts.')->group(function () {
                Route::get('{serviceOrder}/create', [ServiceOrderSparePartController::class, 'create'])->name('create');
                Route::post('/', [ServiceOrderSparePartController::class, 'store'])->name('store');
                Route::put('/{serviceOrderSparePart}', [ServiceOrderSparePartController::class, 'update'])->name('update');
            });

            Route::prefix('bills')->as('bills.')->group(function () {
                Route::get('{serviceOrder}/create', [ServiceOrderBillController::class, 'create'])->name('create');
                Route::post('/', [ServiceOrderBillController::class, 'store'])->name('store');
                Route::put('/{serviceOrderSparePart}', [ServiceOrderBillController::class, 'update'])->name('update');
            });
        });

        Route::prefix('suppliers')->as('suppliers.')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('index');
            Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
            Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update');
            Route::post('/', [SupplierController::class, 'store'])->name('store');
        });

        Route::prefix('workers')->as('workers.')->group(function () {
            Route::get('/', [WorkerlistController::class, 'index'])->name('index');
            Route::post('/', [WorkerlistController::class, 'store'])->name('store');
            Route::put('/{worker}', [WorkerlistController::class, 'update'])->name('update');
            Route::delete('/{worker}', [WorkerlistController::class, 'destroy'])->name('destroy');
        });
    });

Route::middleware('auth')->as('profile.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
    Route::get('/profile/service-orders', [ServiceOrdersController::class, 'profileindex'])->name('service.order.index');
});

Route::get('/pay', [ServiceOrderPaymentController::class, 'pay'])->name('service.orders.pay');
Route::get('/pay/{event}/process', [ServiceOrderPaymentController::class, 'process'])->name('service.orders.process');

Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';
