<?php

namespace Database\Seeders;

use App\Models\Response;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketsWithResponse = Ticket::where('status_id', 3)->get();

        foreach ($ticketsWithResponse as $ticket) {
            Response::factory()->create([
                'ticket_id' => $ticket->id,
                'user_id' => $ticket->assignee_id,
            ]);
        }
    }
}
