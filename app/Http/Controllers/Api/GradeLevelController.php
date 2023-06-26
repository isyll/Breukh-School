<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GradeLevelResource;
use App\Models\GradeLevel;

class GradeLevelController extends Controller
{
    public function all()
    {
        return GradeLevelResource::collection(GradeLevel::all());
    }
}
