<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        include "./database/factories/variables/note_factory_variables.php";

        return [
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'content' => fake()->sentences(rand(1, 6), true),
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ];
    }
}
