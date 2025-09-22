<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use Inertia\Inertia;
use App\Http\Requests\StoreMotorcycleRequest;
use App\Http\Requests\UpdateMotorcycleRequest;

class MotorcycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // Cargar motos con sus relaciones
        $motorcycles = Motorcycle::with(['type', 'cliente', 'type.brand'])
            ->paginate(10);

        return Inertia::render('Dashboard/Motorcycles/MotorcyclesList', [
            'motorcycles' => $motorcycles,
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
    public function store(StoreMotorcycleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Motorcycle $motorcycle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motorcycle $motorcycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMotorcycleRequest $request, Motorcycle $motorcycle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motorcycle $motorcycle)
    {
        //
    }
}
