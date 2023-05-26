<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Response>
 */
class ResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
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
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'content' => implode("\n\n", $this->faker->paragraphs(rand(1, 4))),
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
