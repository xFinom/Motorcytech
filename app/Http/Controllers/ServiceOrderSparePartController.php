<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSparePartsRequest;
use App\Http\Requests\UpdateSparePartsRequest;
use App\Models\ServiceOrderSparePart;
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
    public function create()
    {
        return Inertia::render('Dashboard/SpareParts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSparePartsRequest $request)
    {
        foreach ($request->quotes as $spare_part) {
            StoreSparePartsRequest::create($spare_part);
        }
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
