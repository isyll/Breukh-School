<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolYearResource;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    public function all()
    {
        return SchoolYearResource::collection(SchoolYear::all());
    }

    public function show(Request $request, SchoolYear $school_year)
    {
        return SchoolYearResource::make($school_year);
    }
}
