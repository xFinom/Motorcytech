<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrders;
use App\Http\Requests\StoreServiceOrdersRequest;
use App\Http\Requests\UpdateServiceOrdersRequest;

class ServiceOrdersController extends Controller
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
    public function store(StoreServiceOrdersRequest $request)
    {
        //
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
