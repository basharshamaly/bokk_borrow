<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        // User::create([
        //     'name' => "alaa",
        //     'password' => Hash::make('alaa123'),
        //     'username' => "alaa123",
        //     'actor_type' => "empl",
        //     'actor_id' => 1,
        // ]);
    }
}
