<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GradeLevelClasseResource;
use App\Http\Resources\GradeLevelJoinResource;
use App\Models\Classe;
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

    public function show(Request $request, int $grade_level)
    {
        return $this->runQueryRelations(
            $request,
            GradeLevel::class,
            [
                'classes' => 'classes',
            ],
            $grade_level,
            GradeLevelJoinResource::class
        );
    }
}
