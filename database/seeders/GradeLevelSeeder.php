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
        DB::table('grade_levels')->insert([
            'name'       => 'Elementaire',
            'cycle_name' => 'trimestre',
            'nb_cycles'  => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('grade_levels')->insert([
            'name'       => 'Secondaire',
            'cycle_name' => 'semestre',
            'nb_cycles'  => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
