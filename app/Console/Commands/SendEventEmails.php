<?php

namespace App\Console\Commands;

use App\Mail\EventEmail;
use App\Models\Classe;
use App\Models\SchoolYear;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEventEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breukh:mails';

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
        $this->output->writeln("\n<bg=blue> Envoi des emails </>\n");

        $classes    = Classe::with('events')->with('students')->get();
        $sent       = 0;
        $commingMsg = "Evènements à venir :\n";
        $comming    = [];

        foreach ($classes as $classe) {
            foreach ($classe->events as $event) {
                $eventDate = Carbon::parse($event->date);
                if ($eventDate->isTomorrow()) {
                    foreach ($classe->students as $student)
                        if ($student->state) {
                            $paddedEmail = str_pad(' ' . $student->email, 50, '.', STR_PAD_LEFT);
                            Mail::to($student->email)->send(new EventEmail($event->name, $event->date));
                            $this->info("Envoi $paddedEmail");
                            $sent++;
                        }
                }
                else if ($eventDate->isAfter(Carbon::create())) {
                    $datePadded = str_pad(
                        Carbon::parse($event->date)->toDateString(),
                        50,
                        '.',
                        STR_PAD_LEFT
                    );
                    $info       = "$event->name$datePadded\n";
                    if (!in_array($info, $comming))
                        $comming[] = $info;
                }
            }
        }

        if ($sent == 0)
            $this->output->writeln("\n<bg=blue> Aucun évènement pour demain </>\n");
        else
            $this->output->writeln("\n<bg=blue> $sent emails ont été envoyés </>\n");

        if (!empty($comming)) {
            $this->info($commingMsg);
            $this->info(implode('', $comming));
        }
    }
}