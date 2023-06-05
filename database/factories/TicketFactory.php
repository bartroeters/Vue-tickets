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
            'assignee_id' => $assignee->is_admin ? $assignee->id : null,
            'status_id' => $statusId,
            'title' => ucfirst(Str::remove('.', fake()->unique()->words(rand(1, 5), true))),
            'content' => implode("\n\n", fake()->paragraphs(rand(2, 7))),
            'created_at' => $timestamp,
            'updated_at' => $statusId == 1 ? $timestamp : fake()->dateTimeBetween($timestamp, 'now')
        ];
    }
}
