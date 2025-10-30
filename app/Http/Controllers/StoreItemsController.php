<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreItemsRequest;
use App\Http\Requests\UpdateStoreItemsRequest;
use App\Models\StoreItems;
use Inertia\Inertia;

class StoreItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = StoreItems::all();
        return Inertia::render('Dashboard/Shop/StoreItems', [
        'products' => $products,
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
    public function store(StoreStoreItemsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StoreItems $storeItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreItems $storeItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreItemsRequest $request, StoreItems $storeItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreItems $storeItems)
    {
        //
    }
}
