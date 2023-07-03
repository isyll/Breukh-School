<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = date('Y');

        DB::table('params')->insert([
            'name'       => 'current-year',
            'value'      => $year . '-' . $year + 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}