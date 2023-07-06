<?php

namespace App\Console\Commands;

use App\Models\StudentParent;
use Illuminate\Console\Command;

class SendEventEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:event-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =
        "Envoit des emails aux parents d'élèves pour leur informer de la tenue prochaine d'un évènement";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Envoi des emails aux parents d'élèves");

        $parents = StudentParent::select('email')->get();
        foreach ($parents as $parent) {
            $paddedEmail = str_pad($parent->email, 50, '.', STR_PAD_LEFT);
            $this->info("\nEnvoi$paddedEmail\n");
        }
    }
}
