<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Enrollment;
use App\Models\Param;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;

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
        $student  = $request->validated();
        $classeId = $student['classe'];

        $student = new Student($student);
        $student->save();

        $currentYear = Param::where('name', 'current-year')->first();
        $currentYear = SchoolYear::where('period', $currentYear->value)->first();

        $enrollment = new Enrollment([
            'school_year_id' => $currentYear->id,
            'student_id'     => $student->id,
            'classe_id'      => $classeId,
            'date'           => now()
        ]);

        $enrollment->save();
        return $student;
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
