<?php

// namespace App\Console\Commands;

// use App\Models\Classe;
// use App\Models\SchoolYear;
// use App\Models\StudentParent;
// use Carbon\Carbon;
// use Illuminate\Console\Command;

// class SendEventEmails extends Command
// {
//     /**
//      * The name and signature of the console command.
//      *
//      * @var string
//      */
//     protected $signature = 'app:event-emails';

//     /**
//      * The console command description.
//      *
//      * @var string
//      */
//     protected $description =
//         "Envoit des emails aux parents d'élèves pour leur informer de la tenue prochaine d'un évènement";

//     /**
//      * Execute the console command.
//      */
//     public function handle()
//     {
//         $this->output->writeln("\n<bg=blue> Envoi des emails aux parents d'élèves </>\n");

//         $activeYear  = SchoolYear::where('state', 1)->first()->period;
//         $classes     = Classe::with('events')->with('students')->get();
//         $currentYear = date('Y');
//         $activeYear  = explode('-', $activeYear);
//         $sent        = 0;
//         $commingMsg  = "Evènements à venir :\n";
//         $comming     = [];
//         $tomorrow    = [];

//         foreach ($classes as $classe) {
//             foreach ($activeYear as $year) {
//                 if ($year == $currentYear) {
//                     foreach ($classe->events as $event) {
//                         $eventDate = Carbon::parse($event->date);
//                         if ($eventDate->isTomorrow()) {
//                             if (!in_array($event->name, array_column($tomorrow, 'event')))
//                                 $tomorrow[] = [
//                                     'event'    => $event->name,
//                                     'students' => $classe->students
//                                 ];
//                         }
//                         else {
//                             $datePadded = str_pad(
//                                 Carbon::parse($event->date)->toDateString(),
//                                 50,
//                                 '.',
//                                 STR_PAD_LEFT
//                             );
//                             $info       = "$event->name$datePadded\n";
//                             if (!in_array($info, $comming))
//                                 $comming[] = $info;
//                         }
//                     }
//                 }
//             }
//         }

//         if (empty($tomorrow))
//             $this->output->writeln("\n<bg=blue> Aucun évènement pour demain </>\n");
//         else {
//             foreach ($tomorrow as $t) {
//                 if (
//                     $this->confirm(
//                         "Cet évènement se produit demain : {$t['event']}\n\t" .
//                         "Souhaitez vous envoyer un message aux parents ? "
//                     )
//                 ) {
//                     foreach ($t['students'] as $student) {
//                         $parent      = $student->parent;
//                         $paddedEmail = str_pad(' ' . $parent->email, 50, '.', STR_PAD_LEFT);
//                         $this->info("Envoi $paddedEmail");
//                         $sent++;
//                     }
//                 }
//             }
//             $this->output->writeln("\n<bg=blue> $sent emails ont été envoyés </>\n");
//         }

//         if (!empty($comming)) {
//             $this->info($commingMsg);
//             $this->info(implode('', $comming));
//         }
//     }
// }
