<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            DefaultSettingsSeeder::class,
            DefaultPackagesSeeder::class,
        ]);

        // Optional: Generate dummy data for testing
        $this->call(DummyDataSeeder::class);
    }
}
