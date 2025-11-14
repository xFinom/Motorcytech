<?php

namespace App\Http\Controllers;

use App\Enums\ServiceOrderEvents;
use App\Enums\ServiceOrderStatus;
use App\Http\Requests\StoreServiceOrdersRequest;
use App\Http\Requests\UpdateServiceOrdersRequest;
use App\Models\Brand;
use App\Models\Motorcycle;
use App\Models\Service;
use App\Models\ServiceOrderEvent;
use App\Models\ServiceOrders;
use App\Models\User;
use App\Notifications\NewServiceOrderNotification;
use App\Notifications\NewUserNotification;
use App\Services\ServiceOrderEventPayloadBuilder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ServiceOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     **/
    public function index()
    {
        $serviceOrders = ServiceOrders::query()
            ->with(['motorcycle', 'client', 'motorcycle.type', 'motorcycle.type.brand', 'service'])
            ->latest()
            ->paginate(10);

        return Inertia::render('Dashboard/ServiceOrders/IndexServiceOrder', [
            'serviceOrders' => $serviceOrders,
        ]);
    }

    public function historic()
    {
        $serviceOrders = ServiceOrders::query()
            ->with(['motorcycle', 'client', 'motorcycle.type', 'motorcycle.type.brand', 'service'])
            ->where('status', '!=', ServiceOrderStatus::Finalizado)
            ->latest()
            ->paginate(10);

        return Inertia::render('Dashboard/ServiceOrders/IndexServiceOrder', [
            'serviceOrders' => $serviceOrders,
        ]);
    }

    public function tracking()
    {
        return Inertia::render('Tracking');
    }

public function profileindex()
{
    $serviceOrders = ServiceOrders::query()
        ->where('client_id', Auth::id()) // Usa el helper directamente
        ->with(['motorcycle', 'client', 'motorcycle.type', 'motorcycle.type.brand', 'service'])
        ->paginate(10);

    return Inertia::render('Landing/Profile/ServiceOrdersUser', [
        'serviceOrders' => $serviceOrders,
    ]);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupedTypes = Brand::with('types')->get()->mapWithKeys(function ($brand) {
            return [
                $brand->id => $brand->types->map(fn($type) => [
                    'id' => $type->id,
                    'name' => $type->name,
                ])->toArray(),
            ];
        })->toArray();

        $brands = Brand::query()->pluck('name', 'id')->toArray();
        $services = Service::query()->pluck('name', 'id')->toArray();

        return Inertia::render('Dashboard/ServiceOrders/CreateServiceOrder', [
            'types' => $groupedTypes,
            'brands' => $brands,
            'services' => $services,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceOrdersRequest $request)
    {
        $userData = array_merge($request->client, ['password' => Str::password()]);
        $user = User::query()->create($userData);

        $motorcycleData = array_merge($request->motorcycle, ['id_cliente' => $user->id]);
        $motorcycle = Motorcycle::query()->create($motorcycleData);

        $user->serviceOrders()->create([
            'entry_date' => Carbon::now(),
            'motorcycle_id' => $motorcycle->id,
            'service_id' => $request->service['service_id'],
            'note' => $request->service['note'] ?? '',
        ]);

        $user->notify(new NewUserNotification($user));
        $user->notify(new NewServiceOrderNotification($user));

        return redirect()->route('dashboard.service.orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOrders $serviceOrder)
    {
        // Cargar relaciones necesarias
        $serviceOrder->load([
            'client',
            'motorcycle',
            'motorcycle.type',
            'motorcycle.type.brand',
            'service',
            'privateMessages',
            'privateMessages.user',
            'events'
        ]);

        return Inertia::render('Dashboard/ServiceOrders/OrderTracking', [
            'serviceOrder' => $serviceOrder->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceOrders $serviceOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceOrdersRequest $request, ServiceOrders $serviceOrder) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOrders $serviceOrders)
    {
        //
    }

    public function updateStatus(Request $request, ServiceOrders $serviceOrder)
    {
        $oldStatus = $serviceOrder->status;

        $serviceOrder->status = $request->status;
        $serviceOrder->save();

        ServiceOrderEvent::query()->create([
            'service_order_id' => $serviceOrder->id,
            'type' => ServiceOrderEvents::StatusChange,
            'title' => 'Cambio de estatus',
            'description' => "Su orden de servicio ahora tiene estatus: {$serviceOrder->status->value}.",
            'data' => ServiceOrderEventPayloadBuilder::for(ServiceOrderEvents::StatusChange, [
                'old_status' => $oldStatus,
                'new_status' => $serviceOrder->status,
            ]),
        ]);

        return redirect()->back()->with('success', 'Estado actualizado');
    }
}
