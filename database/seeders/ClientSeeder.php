<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create();
        
        foreach (range(1, 10) as $index) {
            \App\Models\Client::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'contact' => $faker->phoneNumber,
            ]);
        }
    }
}
