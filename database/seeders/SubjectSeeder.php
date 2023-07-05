<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subject_groups')->insert([
            [
                'name'       => 'Mathématiques',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'name'       => 'Activités numériques',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'name'       => 'Langue et communication',
                'updated_at' => now(),
                'created_at' => now(),
            ],
        ]);

        DB::table('subjects')->insert([
            [
                'name'             => 'Arithmétiques',
                'code'             => 'ARI',
                'subject_group_id' => 1,
                'updated_at'       => now(),
                'created_at'       => now(),
            ],
            [
                'name'             => 'Traitement de texte',
                'code'             => 'TDT',
                'subject_group_id' => 2,
                'updated_at'       => now(),
                'created_at'       => now(),
            ],
            [
                'name'             => 'Anglais',
                'code'             => 'ANG',
                'subject_group_id' => 3,
                'updated_at'       => now(),
                'created_at'       => now(),
            ],
        ]);
    }
}
