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
        $this->call([
            GradeLevelSeeder::class,
            ClasseSeeder::class,
            ParamSeeder::class,
            SchoolYearSeeder::class,
            SubjectSeeder::class,
            StudentSeeder::class,
            NoteTypeSeeder::class,
            UserSeeder::class,
            EventSeeder::class,
        ]);
    }
}