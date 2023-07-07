<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\SchoolYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activeYear = SchoolYear::where('state', 1)->first()->id;
        $classes    = Classe::all('id');

        for ($i = 0; $i < 18; $i++) {
            DB::table('parents')->insert([
                'email' => fake()->safeEmail()
            ]);
        }

        foreach ($classes as $classe) {
            for ($i = 0; $i < 10; $i++) {
                DB::table('students')->insert([
                    'firstname'  => fake()->firstName(),
                    'lastname'   => fake()->lastName(),
                    'birthdate'  => fake()->date(),
                    'birthplace' => fake()->randomElement(['Dakar', 'Kilikoro']),
                    'gender'     => fake()->randomElement(['male', 'female']),
                    'profile'    => fake()->randomElement(['internal']),
                    'number'     => $i + 1,
                    'parent_id'  => rand(1, 18)
                ]);

                DB::table('enrollments')->insert([
                    'classe_id'      => $classe->id,
                    'school_year_id' => $activeYear,
                    'student_id'     => DB::getPdo()->lastInsertId(),
                    'date'           => now(),
                ]);
            }
        }
    }
}
