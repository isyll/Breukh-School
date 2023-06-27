<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GradeLevelResource;
use App\Models\GradeLevel;
use App\Traits\JoinQueryParams;
use Illuminate\Http\Request;

class GradeLevelController extends Controller
{
    use JoinQueryParams;

    private array $relations = [
        'classes'
    ];

    public function all(Request $request)
    {
        $collection = GradeLevel::all();

        if ($join = $request->input('join')) {
            $join_items = str_contains($join, ',')
                ? collect(explode(',', $join))
                : collect([$join]);

            foreach ($join_items as $i) {
                $collection->when(
                    in_array($i, $this->relations),
                    function ($collection) use ($i) {
                        $collection = $collection->load($i);
                    }
                );
            }
        }

        return $collection;
    }

    public function show(GradeLevel $grade_level)
    {
        return $grade_level;
    }
}