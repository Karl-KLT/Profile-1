<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Karl',
            'email' => 'mohameddtrsuc9x@gmail.com',
            'password' => Hash::make('mohameddtrsuc9x@gmail.com')
        ]);
    }
}
