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

$statusId = rand(1, 100) <= 55 ? 3 : rand(1, 2);

return [
    'user' => $user,
    'assignee' => $assignee,
    'statusId' => $statusId,
    'timestamp' => $timestamp,
];
