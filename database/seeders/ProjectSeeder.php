<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            \App\Models\Project::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'client_id' => \App\Models\Client::inRandomOrder()->first()->id,
                'status' => $faker->randomElement(['active', 'completed']),
                'deadline' => $faker->dateTimeBetween('now', '+1 year'),
            ]);
        }
    }
}
