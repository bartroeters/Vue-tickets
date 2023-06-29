<?php

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

$ticket = Ticket::inRandomOrder()
    ->where('created_at', '<=', Carbon::now())
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
