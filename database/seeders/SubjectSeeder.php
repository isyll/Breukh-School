<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Subject;
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
                'name' => 'Mathématiques',
            ],
            [
                'name' => 'Activités numériques',
            ],
            [
                'name' => 'Langue et communication',
            ],
        ]);

        DB::table('subjects')->insert([
            [
                'name'             => 'Arithmétiques',
                'code'             => 'ARI',
                'subject_group_id' => 1,
            ],
            [
                'name'             => 'Traitement de texte',
                'code'             => 'TDT',
                'subject_group_id' => 2,
            ],
            [
                'name'             => 'Anglais',
                'code'             => 'ANG',
                'subject_group_id' => 3,
            ],
            [
                'name'             => 'Francais',
                'code'             => 'FRA',
                'subject_group_id' => 3,
            ],
        ]);

        $subjects = ['ANG', 'FRA'];
        $classes  = ['6eme', 'CI', '5eme', 'CE1'];

        foreach ($classes as $classe) {
            $classe = Classe::where('name', $classe)->first();

            foreach ($subjects as $s) {
                $s = Subject::where('code', $s)->first();
                $classe->subjects()->save($s, ['max_note' => 20]);
            }
        }
    }
}
