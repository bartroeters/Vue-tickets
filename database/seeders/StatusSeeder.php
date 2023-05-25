<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Pending', 'In progress', 'Resolved'];

        User::all()->each(function (Ticket $ticket) use ($statuses) {
            $status = Status::factory()->create([
                'title' => fake()->randomStatus($statuses),
            ]);
            $ticket->status()->attach($status);
        });
    }
}
