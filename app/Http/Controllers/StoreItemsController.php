<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreItemsRequest;
use App\Http\Requests\UpdateStoreItemsRequest;
use App\Models\StoreItems;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class StoreItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index()
//    {
//        $products = StoreItems::all();
//
//        return Inertia::render('Dashboard/Shop/StoreItems', [
//        'products' => $products,
//    ]);
//    }
//
//    public function indexDasboard()
//    {
//        $products = StoreItems::query()
//            ->latest()
//            ->paginate(10);
//
//        return Inertia::render('Dashboard/StoreItem/Index', [
//            'products' => $products,
//        ]);
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(StoreStoreItemsRequest $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(StoreItems $storeItems)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(StoreItems $storeItems)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(UpdateStoreItemsRequest $request, StoreItems $storeItems)
//    {
//        if ($request->hasFile('image')) {
//            if ($storeItems->image && Storage::disk('public')->exists($storeItems->image)) {
//                Storage::disk('public')->delete($storeItems->image);
//            }
//
//            $validated['image'] = $request->file('image')->store('store-items', 'public');
//        }
//
//        $storeItems->update($request->all());
//
//        return back()->with('success', 'Artículo actualizado correctamente');
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(StoreItems $storeItems)
//    {
//        //
//    }
}
