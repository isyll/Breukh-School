<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all('id');
        foreach ($students as $student) {
            DB::table('parents')->insert([
                'student_id' => $student->id,
                'email'      => fake()->safeEmail()
            ]);
        }
    }
}