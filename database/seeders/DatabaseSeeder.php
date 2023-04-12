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
            'name' => 'Karl Daniel Dev',
            'email' => 'mohameddtrsuc9x@gmail.com',
            'bio' => 'ղօ օղҽ αskҽժ ตҽ αճօմԵ ตվ síԵմαԵíօղ✌️💔,𝖔𝖗 𝖆𝖘𝖐𝖊𝖉 𝖆𝖇𝖔𝖚𝖙 𝖒𝖊💔👍',
            'country' => 'egypt',
            'type' => UserType::SUPER_ADMIN,
            'message' => "Hello👋 , I appreciate that you are looking at my small site that I've made, anyway this is just an profile image of me just explaining about myself, and I hope that we will be friends.",
            'image' => null,
            'user_code' => random_int(000000000000000000,999999999999999999),
            'email_verified_at' => now(),
            'password' => Hash::make('Hcode0110_Karl')
        ]);


        \App\Models\User::factory(5)->create();
    }
}
