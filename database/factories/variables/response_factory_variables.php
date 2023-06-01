<?php

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

$ticket = Ticket::inRandomOrder()
    ->where('created_at', '<=', Carbon::now())
    ->where('status_id', 3)
    ->first();

$user = User::inRandomOrder()
    ->where('created_at', '<=', Carbon::now())
    ->first();

$timestamp = fake()->dateTimeBetween(
    max($ticket->created_at, $user->created_at),
    'now'
);

return [
    'ticketId' => $ticket,
    'userId' => $user,
    'timestamp' => $timestamp
];

// ideally one response is created for each ticket where status_id is 3 (resolved)