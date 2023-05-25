<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberOfCategories = Category::count();

        Ticket::factory(17)->create()->each(function (Ticket $ticket) use ($numberOfCategories) {
            for ($i = 0; $i < rand(1, $numberOfCategories); $i++) {
                $ticket->categories()->syncWithoutDetaching(rand(1, $numberOfCategories));
            }
        });
    }
}
