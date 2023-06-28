<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseNotifierMail;
use App\Models\Ticket;
use App\Models\User;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ResponseResource::collection(Response::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form view for creating a new response
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResponseRequest $request)
    {
        $validated = $request->validated();

        $response = Response::create($validated);

        $ticket = Ticket::findOrFail($validated['ticketId']);
        
        $user = User::findOrFail($ticket->user_id);

        // Mail::to($user->email)->send(new ResponseNotifierMail($user, $response));

        return new ResponseResource($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        // Show the resource details view for the specified response
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Response $response)
    {
        // Show the form view for editing the specified response
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResponseRequest $request, Response $response)
    {
        $response->update($request->validated());
        return new ResponseResource($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        $response->delete();
        return response()->json(['message' => 'Response deleted successfully']);
    }
}
