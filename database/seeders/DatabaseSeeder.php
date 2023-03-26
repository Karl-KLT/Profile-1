<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Constants\UserType;
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
            'email' => 'test@test.com',
            'bio' => 'this is my bio :)',
            'country' => 'egypt',
            'type' => UserType::CLIENT,
            'message' => "Hello👋 , I appreciate that you are looking at my small site that I've made, anyway this is just an profile image of me just explaining about myself, and I hope that we will be friends.",
            'image' => null,
            'password' => Hash::make('test@test.com')
        ]);
    }
}
