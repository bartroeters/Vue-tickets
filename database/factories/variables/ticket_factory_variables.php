<?php

use App\Models\User;
use Carbon\Carbon;

$user = User::inRandomOrder()
    ->where('created_at', '<=', Carbon::now())
    ->first();

$assignee = User::inRandomOrder()
    ->where('id', '!=', $user->id)
    ->where('created_at', '<=', Carbon::now())
    ->first();

$timestamp = fake()->dateTimeBetween(
    max($user->created_at, $assignee->created_at),
    'now'
);

$statusId = ($assignee->is_admin) ? (rand(1, 100) <= 30 ? 2 : 3) : 1;

return [
    'user' => $user,
    'assignee' => $assignee,
    'statusId' => $statusId,
    'timestamp' => $timestamp,
];
