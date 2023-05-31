<?php

namespace Database\Factories;

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
        include "./database/factories/variables/response_factory_variables.php";

        return [
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'content' => implode("\n\n", $this->faker->paragraphs(rand(1, 4))),
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
