<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(PrioritySeeder::class);
        $this->call(PartsSeeder::class);
        $this->call(ServiceLocationsSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
