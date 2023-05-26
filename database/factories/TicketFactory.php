<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $assignee = User::where('id', '!=', $user->id)->inRandomOrder()->first();
        $timestamp = fake()->dateTimeBetween('-30 days', '-20 minutes');
        $statusId = rand(1, 100) <= 55 ? 3 : rand(1, Status::max('id'));

        // a ticket can't be created after the user or the assignee it belongs to was created.
        // the status of the ID was first created when the ticket was created, then if the StatusId is 2 or 3, it was updated once or twice respectively.

        return [
            'user_id' => $user->id,
            'assignee_id' => $statusId != 1 ? $assignee->id : null,
            'status_id' => $statusId,
            'title' => Str::remove('.', fake()->sentence(2, 5)),
            'content' => implode("\n\n", fake()->paragraphs(rand(1, 2))),
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
