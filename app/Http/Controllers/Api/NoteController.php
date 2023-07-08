<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\ClasseSubject;
use App\Models\Cycle;
use App\Models\Enrollment;
use App\Models\Evaluation;
use App\Models\Note;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Subject;
use Exception;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function addNote(
        Request $request,
        Classe $classe,
        Subject $subject,
        Evaluation $evaluation
    ) {
        $datas = $request->input('notes');
        if (!is_array($datas))
            return response()->json([
                'errors' => [__('messages.input_format_is_invalid')]
            ], 422);

        $result        = [];
        $year          = SchoolYear::where('state', 1)->first()->id;
        $classeSubject = ClasseSubject::where('classe_id', $classe->id)
            ->where('school_year_id', $year)
            ->where('subject_id', $subject->id)->first();

        if (!$classeSubject) {
            return response()->json([
                'errors' => [
                    __(
                        'messages.classe_does_not_have_this_subject',
                        ['classe' => $classe->name, 'subject' => $subject->name]
                    )
                ]
            ], 422);
        }

        foreach ($datas as $data) {
            if (!is_array($data)) {
                throw new Exception("\"notes\" must be of type array of object");
            }

            $validator = Validator::make($data, [
                'student' => 'required|exists:students,id',
                'note'    => 'required|numeric',
                'year'    => 'sometimes|exists:school_years,id',
                'cycle'   => 'required'
            ]);

            if (!$validator->fails()) {
                if ($data['note'] > $classeSubject->max_note) {
                    return response()->json([
                        'errors' => [
                            __('messages.note_greater_than_max', [
                                'note' => $data['note'],
                                'max'  => $classeSubject->max_note
                            ])
                        ]
                    ], 422);
                }

                $cycle = Cycle::find($classe->gradeLevel->cycle_id);

                if ($data['cycle'] < 1 || $data['cycle'] > $cycle->number) {
                    return response()->json([
                        'errors' => [__('messages.choosen_cycle_is_invalid')]
                    ], 422);
                }

                $enrollment = Enrollment::where('student_id', $data['student'])
                    ->where('classe_id', $classe->id)
                    ->where('school_year_id', $year)
                    ->first();

                if (!$enrollment) {
                    $student = Student::find($data['student']);
                    return response()->json([
                        'errors' => [
                            __('messages.student_not_enrolled_in_this_class', [
                                'firstname'  => $student->firstname,
                                'lastname'   => $student->lastname,
                                'class_name' => $classe->name
                            ])
                        ]
                    ], 422);
                }

                $note = Note::where('enrollment_id', $enrollment->id)
                    ->where('classe_subject_id', $classeSubject->id)
                    ->where('evaluation_id', $evaluation->id)
                    ->where('cycle', $data['cycle'])
                    ->first();

                if ($note) {
                    $note->value = $data['note'];
                    $note->save();
                }
                else {
                    $note                    = new Note;
                    $note->enrollment_id     = $enrollment->id;
                    $note->classe_subject_id = $classeSubject->id;
                    $note->evaluation_id     = $evaluation->id;
                    $note->cycle             = $data['cycle'];
                    $note->value             = $data['note'];
                    $note->save();
                }

                $result[] = $note;
            }
            else {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
        }

        return $result;
    }

    public function addStudentNote(
        Request $request,
        Classe $classe,
        Subject $subject,
        Evaluation $evaluation,
        Student $student
    ) {
        $datas = $request->input('notes');
        if (!is_array($datas))
            return response()->json([
                'errors' => [__('messages.input_format_is_invalid')]
            ], 422);

        $result        = [];
        $year          = SchoolYear::where('state', 1)->first()->id;
        $classeSubject = ClasseSubject::where('classe_id', $classe->id)
            ->where('school_year_id', $year)
            ->where('subject_id', $subject->id)->first();
        $enrollment    = Enrollment::where('student_id', $student->id)
            ->where('classe_id', $classe->id)
            ->where('school_year_id', $year)
            ->first();

        if (!$classeSubject) {
            return response()->json([
                'errors' => [
                    __(
                        'messages.classe_does_not_have_this_subject',
                        ['classe' => $classe->name, 'subject' => $subject->name]
                    )
                ]
            ], 422);
        }

        if (!$enrollment) {
            return response()->json([
                'errors' => [
                    __('messages.student_not_enrolled_in_this_class', [
                        'firstname'  => $student->firstname,
                        'lastname'   => $student->lastname,
                        'class_name' => $classe->name
                    ])
                ]
            ], 422);
        }

        foreach ($datas as $data) {
            if (!is_array($data)) {
                throw new Exception("\"notes\" must be of type array of object");
            }

            $validator = Validator::make($data, [
                'note'  => 'required|numeric',
                'year'  => 'sometimes|exists:school_years,id',
                'cycle' => 'required'
            ]);

            if (!$validator->fails()) {
                if ($data['note'] > $classeSubject->max_note) {
                    return response()->json([
                        'errors' => [
                            __('messages.note_greater_than_max', [
                                'note' => $data['note'],
                                'max'  => $classeSubject->max_note
                            ])
                        ]
                    ], 422);
                }

                $cycle = Cycle::find($classe->gradeLevel->cycle_id);

                if ($data['cycle'] < 1 || $data['cycle'] > $cycle->number) {
                    return response()->json([
                        'errors' => [__('messages.choosen_cycle_is_invalid')]
                    ], 422);
                }

                $note = Note::where('enrollment_id', $enrollment->id)
                    ->where('classe_subject_id', $classeSubject->id)
                    ->where('evaluation_id', $evaluation->id)
                    ->where('cycle', $data['cycle'])
                    ->first();

                if ($note) {
                    $note->value = $data['note'];
                    $note->save();
                }
                else {
                    $note                    = new Note;
                    $note->enrollment_id     = $enrollment->id;
                    $note->classe_subject_id = $classeSubject->id;
                    $note->evaluation_id     = $evaluation->id;
                    $note->cycle             = $data['cycle'];
                    $note->value             = $data['note'];
                    $note->save();
                }

                $result[] = $note;
            }
            else {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
        }

        return $result;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
