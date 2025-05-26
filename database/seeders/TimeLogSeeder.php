<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeLogSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        foreach( range(1, 50) as $index) {
            $start_time = $faker->dateTimeBetween('-2 year', '-1 year');
            $end_time = now();
            $hours = $end_time->diff($start_time);

            \App\Models\TimeLog::create([
                'project_id' => \App\Models\Project::inRandomOrder()->first()->id,
                'project_id' => \App\Models\Project::inRandomOrder()->first()->id,
                'description' => $faker->sentence,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'hours' => $hours,
            ]);
        }
    }
}
