<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes        = Classe::all();
        $event          = new Event;
        $event->name    = 'Activités culturelles 2023';
        $event->date    = Carbon::tomorrow();
        $event->user_id = fake()->randomElement(User::all())->id;
        $event->save();

        foreach ($classes as $classe) {
            $classe->events()->save($event);
        }
    }
}