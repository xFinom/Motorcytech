<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use GrahamCampbell\ResultType\Success;
use Inertia\Inertia; 
use Illuminate\Http\Request;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('company')
                             ->paginate(10);

        return Inertia::render('Dashboard/Supplier/SuppliersList', [
            'suppliers' => $suppliers
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
    public function store(StoreSupplierRequest $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'representative' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'product' => 'nullable|string|max:255',
        ]);

         $supplier = Supplier::create($validated);

        // Responder con Inertia o redirigir
        return redirect()->route('supplierslist')->with('success', 'Proveedor creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'representative' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:suppliers,email,'.$supplier->id,
            'phone' => 'nullable|string|max:20',
            'product' => 'required|string|max:150',

        ]);

        $supplier->update($validated);

        return redirect()->route('supplierslist')->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

         return redirect()->route('supplierslist')->with('success', 'Proveedor eliminado correctamente.');
    }
}
