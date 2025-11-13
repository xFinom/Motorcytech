<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ServiceForecastController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Gate::allowIf(Auth::user()?->role === UserRole::Admin);

        return Inertia::render('Dashboard/DataMining/ForecastServices');
    }
}
