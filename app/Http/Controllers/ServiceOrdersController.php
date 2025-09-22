<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MotorcycleType;
use App\Models\ServiceOrders;
use App\Http\Requests\StoreServiceOrdersRequest;
use App\Http\Requests\UpdateServiceOrdersRequest;
use Inertia\Inertia;

class ServiceOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceOrders = ServiceOrders::query()
            ->with(['motorcycle', 'client', 'motorcycle.type', 'motorcycle.type.brand', 'service'])
            ->paginate(10);

        return Inertia::render('Dashboard/ServiceOrders/IndexServiceOrder', [
            'serviceOrders' => $serviceOrders
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
                $brand->id => $brand->types->map(fn($type) => [
                    'id' => $type->id,
                    'name' => $type->name,
                ])->toArray(),
            ];
        })->toArray();

        $brands = Brand::query()->pluck('name', 'id')->toArray();

        return Inertia::render('Dashboard/ServiceOrders/CreateServiceOrder', [
            'types' => $groupedTypes,
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceOrdersRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOrders $serviceOrders)
    {
        //
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
    public function update(UpdateServiceOrdersRequest $request, ServiceOrders $serviceOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOrders $serviceOrders)
    {
        //
    }
}
