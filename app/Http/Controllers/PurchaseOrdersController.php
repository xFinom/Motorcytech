<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseOrdersRequest;
use App\Http\Requests\UpdatePurchaseOrdersRequest;
use App\Models\PurchaseOrders;

class PurchaseOrdersController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseOrdersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrders $purchaseOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrders $purchaseOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseOrdersRequest $request, PurchaseOrders $purchaseOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrders $purchaseOrders)
    {
        //
    }
}
