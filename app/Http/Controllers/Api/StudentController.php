<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Classe;
use App\Models\Enrollment;
use App\Models\Note;
use App\Models\Param;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $student           = $request->validated();
        $student['number'] = $this->getAvailableNumber();
        $classeId          = $student['classe'];
        $currentYear       = SchoolYear::currentYear();

        DB::beginTransaction();
        $student = new Student($student);
        $student->save();

        $enrollment = new Enrollment([
            'school_year_id' => $currentYear->id,
            'student_id'     => $student->id,
            'classe_id'      => $classeId,
        ]);

        $enrollment->save();
        DB::commit();

        return $student;
    }

    public function getAvailableNumber()
    {
        $result = Student::selectRaw('MIN(number+1) AS num')
            ->from('students AS s1')
            ->whereNotExists(function ($query) {
                $query->selectRaw(1)
                    ->from('students AS s2')
                    ->whereRaw('s2.number = s1.number + 1 and s2.state = 1');
            })
            ->limit(1)
            ->get()[0];

        if ($result->num === NULL)
            return 1;
        return $result->num;
    }

    public function addNote(Request $request, Student $student)
    {
        $datas = $request->input();

        foreach ($datas as $data) {
            $validator = $this->validateDatas($data);

            if (!$validator->fails()) {
                $year = isset($data['year'])
                    ? SchoolYear::find($data['year'])->id
                    : SchoolYear::where('state', 1)->first()->id;

                $enrollment = Enrollment::where('student_id', $data['student'])
                    ->where('classe_id', $data['classe'])
                    ->where('school_year_id', $year)
                    ->first();

                $classeSubject = Classe::find($data['classe'])
                    ->subjects()->wherePivot('subject_id', $data['subject'])
                    ->first()?->pivot->classe_id;

                if ($classeSubject) {
                    $note = Note::where('enrollment_id', $enrollment->id)
                        ->where('classe_subject_id', $classeSubject)
                        ->where('evaluation_id', $data['evaluation'])
                        ->first();

                    if ($note) {
                        $note->value = $data['note'];
                        $note->save();
                    }
                    else
                        $enrollment->notes()->attach($classeSubject, [
                            'value'         => $data['note'],
                            'evaluation_id' => $data['evaluation']
                        ]);
                    return $enrollment;
                }
                else {
                    $classe  = Classe::find($data['classe']);
                    $subject = Classe::find($data['subject']);

                    return response()->json([
                        'errors' => [
                            $data['subject'] => [
                                "La classe $classe->name ne possède pas le sujet $subject->name"
                            ]
                        ]
                    ], 422);
                }
            }
            else {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
        }
    }

    /**
     * Delete student state.
     */
    public function out(Request $request)
    {
        return $this->changeState($request, 0);
    }

    /**
     * Restore student state.
     */
    public function in(Request $request)
    {
        return $this->changeState($request, 1);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    private function changeState(Request $request, int $state)
    {
        $result = [];

        if ($request->input('id'))
            $datas = [$request->input('id')];
        else
            $datas = $request->input();

        foreach ($datas as $item) {
            if ($student = Student::find($item)) {
                $student->state = $state;
                $student->save();
            }
            else {
                $result['errors'][$item] = ['Etudiant non trouvé'];
                $result['message']       = 'Au moins un élève inexistant';
            }
        }

        if (array_key_exists('errors', $result))
            return response()->json($result, 404);

        $result['message'] = 'Donées enregistrées';
        return $result;
    }

    private function validateDatas(array $data)
    {
        return Validator::make($data, [
            'student'    => 'required|exists:students,id',
            'classe'     => 'required|exists:classes,id',
            'subject'    => 'required|exists:subjects,id',
            'evaluation' => 'required|exists:evaluations,id',
            'year'       => 'sometimes|exists:school_years,id',
            'note'       => 'required|numeric'
        ]);
    }
}