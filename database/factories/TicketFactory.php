<?php

namespace Database\Factories;

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
        include "./database/factories/variables/ticket_factory_variables.php";

        return [
            'user_id' => $user->id,
            'assignee_id' => $statusId != 1 ? $assignee->id : null,
            'status_id' => $statusId,
            'title' => Str::remove('.', fake()->unique()->sentence(2, 5)),
            'content' => implode("\n\n", fake()->paragraphs(rand(1, 4))),
            'created_at' => $timestamp,
            'updated_at' =>
                $statusId === 2 ? fake()->dateTimeBetween($timestamp, 'now') : (
                $statusId === 3 ? fake()->dateTimeBetween($timestamp, 'now') :
                $timestamp
            ),
        ];
    }
}
