<?php

namespace Database\Seeders;

use App\Models\GradeLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elementaire = GradeLevel::where('name', 'Elementaire')->first();
        $secondaire  = GradeLevel::where('name', 'Secondaire')->first();

        $classes = ['CI', 'CP', 'CE1', 'CE2'];

        foreach ($classes as $classe) {
            DB::table('classes')
                ->insert([
                    'name'           => $classe,
                    'grade_level_id' => $elementaire->id,
                    'created_at'     => now(),
                    'updated_at'     => now()
                ]);
        }

        $classes = ['6eme', '5eme'];

        foreach ($classes as $classe) {
            DB::table('classes')
                ->insert([
                    'name'           => $classe,
                    'grade_level_id' => $secondaire->id,
                    'created_at'     => now(),
                    'updated_at'     => now()
                ]);
        }
    }
}
