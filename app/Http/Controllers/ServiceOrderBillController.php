<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Enums\ServiceOrderEvents;
use App\Http\Requests\StoreBillsRequest;
use App\Http\Requests\UpdateBillsRequest;
use App\Models\ServiceOrderBill;
use App\Models\ServiceOrderEvent;
use App\Models\ServiceOrders;
use App\Services\ServiceOrderEventPayloadBuilder;
use Illuminate\Http\Request;

class ServiceOrderBillController extends Controller
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
        return inertia('Dashboard/Bill/Create', [
            'service_order' => $serviceOrder,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_order_id' => 'required|string|exists:service_orders,id',
            'bills'            => 'required|array|min:1',
            'bills.*.description' => 'required|string',
            'bills.*.price' => 'required|numeric|min:0',
        ]);

        $billIds = [];
        $totalAmount = 0;

        foreach ($validated['bills'] as $billData) {
            $bill = ServiceOrderBill::query()->create([
                'description'      => $billData['description'],
                'price'            => $billData['price'],
                'payment_status'   => PaymentStatus::Pendiente,
                'service_order_id' => $request->service_order_id,
            ]);

            $billIds[] = $bill->id;
            $totalAmount += $bill->price;
        }

        // Create event entry
        ServiceOrderEvent::query()->create([
            'service_order_id' => $request->service_order_id,
            'type'        => ServiceOrderEvents::BillGenerated,
            'title'       => 'Nueva factura generada',
            'description' => "Se generaron {$totalAmount} MXN en facturas.",
            'data'        => ServiceOrderEventPayloadBuilder::for(
                ServiceOrderEvents::BillGenerated,
                [
                    'bills_id' => $billIds,
                    'amount' => $totalAmount,
                ]
            ),
        ]);

        return redirect()->route('dashboard.service.orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOrderBill $bills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceOrderBill $bills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillsRequest $request, ServiceOrderBill $bills)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOrderBill $bills)
    {
        //
    }
}
