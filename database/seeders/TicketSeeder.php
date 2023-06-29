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
        Ticket::factory(15)->create()->each(function (Ticket $ticket) {
            $syncedCategories = Category::inRandomOrder()->pluck('id')->random(rand(1, min(4, Category::count())));

            $ticket->categories()->sync($syncedCategories);
        });
    }
}
