<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentListResource;
use App\Models\Classe;
use App\Models\Enrollment;
use App\Models\Param;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function studentsList(Classe $classe)
    {
        return StudentListResource::collection($classe->students);
    }
}
