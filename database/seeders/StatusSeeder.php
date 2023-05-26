<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::factory()->createMany([
            ['title' => 'Pending'],
            ['title' => 'In progress'],
            ['title' => 'Resolved']
        ]);
    }
}
