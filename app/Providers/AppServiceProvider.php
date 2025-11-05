<?php

namespace App\Providers;

use App\Models\ServiceOrderEvent;
use App\Observers\ServiceOrderEventObserver;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(app()->isProduction()) {
            URL::forceScheme('https');
        }

        ServiceOrderEvent::observe(ServiceOrderEventObserver::class);
        Vite::prefetch(concurrency: 3);
    }
}
