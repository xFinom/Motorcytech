<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrders;
use Inertia\Inertia;

class PurchaseOrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = PurchaseOrders::with(['client', 'items'])->paginate(10);

        // Transformar para Vue
        $ordersTransformed = $orders->through(function ($order) {
            $items = $order->items->map(fn($i) => [
                'id' => $i->id,
                'name' => $i->name,
                'price' => $i->price, // agregamos el precio individual
            ])->toArray();

            $totalPrice = $order->items->sum('price'); // suma de todos los precios

            return [
                'id' => $order->id,
                'client_name' => $order->client->name,
                'items' => $items,
                'total_price' => $totalPrice, // nuevo campo
            ];
        });

        return Inertia::render('Dashboard/PurchaseOrderItem/PurchaseOrderList', [
            'orders' => $ordersTransformed
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
