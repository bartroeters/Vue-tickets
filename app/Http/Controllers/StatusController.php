<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Resources\StatusResource;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StatusResource::collection(Status::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form view for creating a new status
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request)
    {
        $status = Status::create($request->validated());
        return new StatusResource($status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        // Show the resource details view for the specified status
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        // Show the form view for editing the specified status
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $status)
    {
        $status->update($request->validated());
        return new StatusResource($status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $status->delete();
    }
}
