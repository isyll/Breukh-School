<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = date('Y');

        for ($y = $year; $y < $year + 4; $y++) {
            DB::table('school_years')->insert([
                'period'     => $y . '-' . $y + 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}