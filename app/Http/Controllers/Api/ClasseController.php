<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClasseJoinResource;
use App\Http\Resources\ClasseResource;
use App\Models\Classe;
use App\Models\Subject;
use App\Traits\JoinQueryParams;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    use JoinQueryParams;

    public function addSubject(Request $request, Classe $classe)
    {
        $subject = Subject::where('name', $request->input('subject'))->first();

        if (!$subject) {
            $group = $request->input('group');
            $name  = $request->input('subject');

            if ($group && ($group = Subject::where('name', $group)->first()))
                $group = $group->id;
            else
                $group = null;

            $subject = new Subject([
                'name'             => $name,
                'code'             => SubjectController::getCode($name),
                'subject_group_id' => $group
            ]);

            $subject->save();
        }

        $classe->subjects()->save($subject);
        return ClasseResource::make($classe);
    }

    public function show(Request $request, int $classe)
    {
        return $this->runQueryRelations(
            $request,
            Classe::class,
            [
                'disciplines' => 'subjects',
                'eleves'      => 'students',
                'evenements'  => 'events'
            ],
            $classe,
            ClasseJoinResource::class
        );
    }
}