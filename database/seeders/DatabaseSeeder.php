<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test Admin',
            'password' => 0,
            'email' => 'admin@test.com',
        ]);

        $this->call([
            ClientSeeder::class,
        ]);
    }
}
