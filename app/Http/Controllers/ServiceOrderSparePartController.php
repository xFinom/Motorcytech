<?php

namespace App\Http\Controllers;

use App\Enums\ApprovalStatus;
use App\Enums\ServiceOrderEvents;
use App\Http\Requests\StoreSparePartsRequest;
use App\Http\Requests\UpdateSparePartsRequest;
use App\Models\ServiceOrderEvent;
use App\Models\ServiceOrders;
use App\Models\ServiceOrderSparePart;
use App\Services\ServiceOrderEventPayloadBuilder;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ServiceOrderSparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ServiceOrders $serviceOrder)
    {
        return Inertia::render('Dashboard/SpareParts/Create', [
            'service_order' => $serviceOrder
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(StoreSparePartsRequest $request)
    {
        $partsIds = [];
        $totalCost = 0;

        foreach ($request->quotes as $spare_part) {
            $quote = ServiceOrderSparePart::query()->create([
                'service_order_id' => $request->service_order_id,
                'name' => $spare_part['name'],
                'price' => $spare_part['price'],
                'quantity' => $spare_part['quantity'],
            ]);

            $partsIds[] = $quote->id;
            $totalCost += $quote->price * $quote->quantity;
        }

        $partsCount = count($partsIds);

        ServiceOrderEvent::query()->create([
            'service_order_id' => $request->service_order_id,
            'type' => ServiceOrderEvents::SparePartQuote,
            'title' => 'Cotización de refacciones',
            'description' => "Se registraron {$partsCount} refacciones por un total de $$totalCost.",
            'approval_status' => ApprovalStatus::Pending,
            'data' => ServiceOrderEventPayloadBuilder::for(
                ServiceOrderEvents::SparePartQuote,
                [
                    'parts_count' => $partsCount,
                    'parts_id' => $partsIds,
                    'total_cost' => $totalCost,
                ]
            ),
        ]);

        return redirect()->route('dashboard.service.orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOrderSparePart $spareParts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceOrderSparePart $spareParts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSparePartsRequest $request, ServiceOrderSparePart $spareParts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOrderSparePart $spareParts)
    {
        //
    }
}
