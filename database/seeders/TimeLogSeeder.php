<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeLogSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $projects = \App\Models\Project::latest()->get()->pluck('id');

        foreach( $projects as $index) {
            $start_time = $faker->dateTimeBetween('-2 year', '-1 year');
            $end_time = now();
            $hours = $end_time->diff($start_time);

            \App\Models\TimeLog::create([
                'project_id' => $index,
                'description' => $faker->sentence,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'hours' => $hours,
            ]);
        }
    }
}
