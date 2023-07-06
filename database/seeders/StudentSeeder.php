<?php

namespace Database\Seeders;

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
        DB::table('students')->insert([
            'firstname'  => 'Amar',
            'lastname'   => 'Thiam',
            'birthdate'  => '2023-03-02',
            'birthplace' => 'Dakar',
            'gender'     => "male",
            'profile'    => 'internal',
            'number'     => 1
        ]);

        DB::table('enrollments')->insert([
            'classe_id'      => 1,
            'school_year_id' => 1,
            'student_id'     => 1,
            'updated_at'     => now(),
            'created_at'     => now(),
        ]);
    }
}
