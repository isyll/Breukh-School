<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cycles')->insert([
            [
                'name'   => 'semestre',
                'number' => 2
            ],
            [
                'name'   => 'trimestre',
                'number' => 3
            ],
        ]);

        DB::table('grade_levels')->insert([
            [
                'name'     => 'Elementaire',
                'cycle_id' => 2,
            ],
            [
                'name'     => 'Secondaire',
                'cycle_id' => 1,
            ]
        ]);
    }
}