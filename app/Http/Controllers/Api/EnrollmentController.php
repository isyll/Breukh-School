<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Enrollment;
use App\Models\Param;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function studentsList(int $classeId)
    {
        $list = Classe::findOrFail($classeId);
        $list = $list->students;

        return $list;
    }
}
