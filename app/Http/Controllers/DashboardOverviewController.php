<?php

namespace App\Http\Controllers;

use App\Enums\ReviewStatus;
use App\Enums\ServiceOrderStatus;
use App\Enums\UserRole;
use App\Models\Reviews;
use App\Models\ServiceOrders;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardOverviewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currentYeaServiceOrders = ServiceOrders::query()
            ->where('service_orders.entry_date', '>=', now()->firstOfYear());

        $totalServiceOrders = $currentYeaServiceOrders->count();
        $totalClients = $currentYeaServiceOrders
            ->withCount('client')
            ->count();
        $totalMotorcycles = $currentYeaServiceOrders
            ->where('service_orders.status', '!=', ServiceOrderStatus::Finalizado)
            ->count();
        $totalPendingReviews = Reviews::query()->where('reviews.status', ReviewStatus::Pendiente)->count();

        $chartData = ServiceOrders::query()
            ->where('service_orders.entry_date', '>=', now()->firstOfYear())
            ->selectRaw('service_id, COUNT(*) as total')
            ->with('service:id,name')
            ->groupBy('service_id')
            ->get()
            ->map(fn ($order) => [
                'name' => $order->service->name,
                'total' => $order->total,
            ]);
        $recentClients = User::query()->where('users.role', UserRole::Cliente)->latest()->take(7)->get();

        return Inertia::render('Dashboard/Overview/Overview', [
            'totalServiceOrders' => $totalServiceOrders,
            'totalClients' => $totalClients,
            'totalMotorcycles' => $totalMotorcycles,
            'totalPendingReviews' => $totalPendingReviews,
            'chartData' => $chartData,
            'recentClients' => $recentClients,
        ]);
    }
}
