<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceOrdersRequest;
use App\Http\Requests\UpdateServiceOrdersRequest;
use App\Models\Brand;
use App\Models\Motorcycle;
use App\Models\ServiceOrders;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO: crear tabla de servicios
        $groupedTypes = Brand::with('types')->get()->mapWithKeys(function ($brand) {
            return [
                $brand->id => $brand->types->map(fn ($type) => [
                    'id' => $type->id,
                    'name' => $type->name,
                ])->toArray(),
            ];
        })->toArray();

        $brands = Brand::query()->pluck('name', 'id')->toArray();

        return Inertia::render('Dashboard/ServiceOrders/CreateServiceOrder', [
            'types' => $groupedTypes,
            'brands' => $brands,
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
            'note' => $request->service['note'],
        ]);

        return redirect()->route('service.order.index');
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
        ]);

        // Historial de eventos mapeado para el front-end
        $orderHistory = $serviceOrder->events()
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($event) {
                return [
                    'date' => $event->created_at->format('d M Y, H:i'),
                    'title' => $event->title,
                    'description' => $event->description,
                    'status' => match ($event->type) {
                        'StatusChange' => 'completed', // o mapear según tus tipos
                        default => 'created',
                    },
                ];
            })
            ->toArray();

        return Inertia::render('Dashboard/ServiceOrders/OrderTracking', [
            'serviceOrder' => $serviceOrder->toArray(),
            'orderHistory' => $orderHistory,
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
        $serviceOrder->status = $request->status;
        $serviceOrder->save();

        return redirect()->back()->with('success', 'Estado actualizado');
    }
}
