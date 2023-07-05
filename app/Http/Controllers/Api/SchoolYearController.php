<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;

class SchoolYearController extends Controller
{
    public function all()
    {
        return SchoolYear::all();
    }
}
