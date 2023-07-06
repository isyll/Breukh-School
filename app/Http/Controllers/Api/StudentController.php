<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $data        = $request->validated();
        $classeId    = $data['classe'];
        $currentYear = SchoolYear::currentYear();

        $student             = new Student;
        $student->number     = Student::getAvailableNumber();
        $student->firstname  = $data['firstname'];
        $student->lastname   = $data['lastname'];
        $student->gender     = $data['gender'];
        $student->profile    = $data['profile'];
        $student->birthdate  = $data['birthdate'] ?: null;
        $student->birthplace = $data['birthplace'] ?: null;

        DB::beginTransaction();
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
        $datas = $request->input('id');

        foreach ($datas as $item) {
            if ($student = Student::find($item)) {
                $student->state = $state;
                $student->save();
            }
            else {
                $result['errors'][$item] = [__('messages.student_not_found')];
                $result['message']       = __('messages.at_least_one_student_not_found');
            }
        }

        if (array_key_exists('errors', $result))
            return response()->json($result, 404);

        $result['message'] = __('messages.the_data_has_been_saved');
        return $result;
    }
}
