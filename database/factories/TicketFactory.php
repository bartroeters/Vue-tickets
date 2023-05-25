<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
// class TicketFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         return [
//             'user_id' => User::inRandomOrder()->first()->id,
//             'assignee_id' => User::inRandomOrder()->first()->id,
//             'status_id' => Status::inRandomOrder()->first()->id,
//             'title' => Str::remove('.', fake()->sentence(2, 5)),
//             'content' => implode(fake()->paragraphs(4)) . '&nbsp'
//         ];
//     }
// }

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

        return [
            'user_id' => $user->id,
            'assignee_id' => $assignee->id,
            'status_id' => Status::inRandomOrder()->first()->id,
            'title' => Str::remove('.', fake()->sentence(2, 5)),
            'content' => implode(fake()->paragraphs(4) . '&nbsp')
        ];
    }
}
