<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewsRequest;
use App\Models\Reviews;
use App\Enums\ReviewStatus;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Reviews::with('client')
            ->where('status', '!=', \App\Enums\ReviewStatus::Pendiente) // excluye en espera
            ->get();

        return Inertia::render('Dashboard/Reviews/ReviewsShow', [
            'reviews' => $reviews
        ]);
    }

    public function validreview()
    {
        $reviews = Reviews::with('client')
            ->where('status', '!=', \App\Enums\ReviewStatus::Validado) // excluye Validados
            ->get();

        return Inertia::render('Dashboard/Reviews/ValidReviews', [
            'reviews' => $reviews
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Normalmente usamos Inertia para renderizar el formulario
        // return Inertia::render('Dashboard/ServiceOrders/ReviewsForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewsRequest $request)
    {
        $validated = $request->validated();

        Reviews::create([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'status' => ReviewStatus::Pendiente,
            'client_id' => Auth::id(), // 🔹 aquí asignamos el usuario logueado
        ]);

        return redirect()->back()->with('success', '¡Gracias por tu reseña!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reviews $reviews)
    {
        // Opcional: mostrar un review específico
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reviews $reviews)
    {
        // Opcional: editar un review
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Reviews $request, Reviews $reviews)
    {
        // Opcional: actualizar un review
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reviews $review)
    {
        $review->delete();

        return redirect()->back()->with('success', '¡Tu reseña se elimino correctamente!');
    }

    // Validar review
    public function validateReview($id)
    {
        $review = Reviews::findOrFail($id);
        $review->status = ReviewStatus::Validado;
        $review->save();

        return redirect()->back()->with('success', 'Reseña validada correctamente');
    }
}
