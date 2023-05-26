<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run() {
        User::factory()->create([
            'first_name' => 'Henk',
            'last_name' => 'Steen',
            'email' => 'henksteen@mail.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'remember_token' => Str::random(10),
            'phonenumber' => '0612345678'
        ]);

        User::factory(7)->create();
    }
}