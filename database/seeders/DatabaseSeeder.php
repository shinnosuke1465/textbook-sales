<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Faculty;
use App\Models\ItemCondition;
use App\Models\Textbook;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UniversitySeeder::class,
            FacultySeeder::class,
            FacultySeeder::class,
            ItemConditionSeeder::class,
            UserSeeder::class
        ]);

        // Textbook::factory(3)->create();
        // Stock::factory(3)->create();
    }
}
