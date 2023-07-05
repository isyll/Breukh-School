<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Enrollment;
use App\Models\Param;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $currentYear = SchoolYear::currentYear();

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

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
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
}
