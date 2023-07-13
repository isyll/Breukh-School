<?php

namespace App\Http\Resources;

use App\Models\GradeLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClasseJoinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'classe' => $this['name'],
            'niveau' => GradeLevel::find($this['grade_level_id'])->name,
        ];

        if (isset($this['students'])) {
            foreach ($this['students'] as $student)
                $data['eleves'][] = [
                    'prenom'    => $student['firstname'],
                    'nom'       => $student['lastname'],
                    'email'     => $student['email'],
                    'naissance' => $student['birthdate'],
                    'sexe'      => $student['gender'],
                    'profil'    => $student['profile']
                ];
        }
        if (isset($this['subjects'])) {
            foreach ($this['subjects'] as $subject)
                $data['disciplines'][] = ['libelle' => $subject['name']];
        }
        if (isset($this['events'])) {
            foreach ($this['events'] as $event)
                $data['evenements'][] = ['sujet' => $event['name']];
        }

        return $data;
    }
}
