<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrivateMessagesRequest;
use App\Http\Requests\UpdatePrivateMessagesRequest;
use App\Models\PrivateMessages;

class PrivateMessagesController extends Controller
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
    public function store(StorePrivateMessagesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PrivateMessages $privateMessages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrivateMessages $privateMessages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrivateMessagesRequest $request, PrivateMessages $privateMessages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrivateMessages $privateMessages)
    {
        //
    }
}
