<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GradeLevelClasseResource;
use App\Http\Resources\GradeLevelResource;
use App\Models\GradeLevel;
use App\Traits\JoinQueryParams;
use Illuminate\Http\Request;

class GradeLevelController extends Controller
{
    use JoinQueryParams;

    public function all(Request $request)
    {
        return GradeLevelClasseResource::collection(GradeLevel::all());
    }

    public function show(GradeLevel $grade_level)
    {
        return $grade_level;
    }
}
