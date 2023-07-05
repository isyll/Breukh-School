<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('note_types')->insert([
            [
                'name' => 'devoir'
            ],
            [
                'name' => 'examen'
            ],
            [
                'name' => 'composition'
            ]
        ]);
    }
}