<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Resources\SubjectGroupsResource;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use App\Models\SubjectGroup;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function all()
    {
        return SubjectResource::collection(Subject::with('group')->get());
    }

    public function allGroups()
    {
        return SubjectGroupsResource::collection(SubjectGroup::all());
    }

    public function store(StoreSubjectRequest $request)
    {
        $datas = $request->validated();
        if (Subject::where('name', $datas['name'])->exists())
            return response()->json([
                'errors' => [
                    [
                        'name' => ['Ce nom existe déjà']
                    ]
                ]
            ], 422);

        $group     = SubjectGroup::find($datas['group']);
        $sbj       = new Subject;
        $sbj->name = $datas['name'];
        $sbj->code = self::getCode($datas['name']);

        $group->subjects()->save($sbj);
        return $sbj;
    }

    public function test($test)
    {
        return $this->getCode($test);
    }

    public static function getCode(string $name)
    {
        $name = strtoupper(trim($name));

        if (count(explode(' ', $name)) === 1) {
            if (Subject::where('code', $name)->exists()) {
                $i    = 1;
                $code = $name;

                do {
                    $code .= $i++;
                } while (Subject::where('code', $code)->exists());
                return $code;
            }

            $length = 3;
            do {
                $code = substr($name, 0, $length++);
            } while (Subject::where('code', $code)->exists());
        }
        else {
            $code = [];
            preg_match_all('/\b[a-zA-Z]/', $name, $code);
            $code = implode('', $code[0]);

            $offset = 1;
            $suffix = "";
            while (Subject::where('code', $code . $suffix)->exists()) {
                $suffix .= substr($name, $offset++, 1);
            }

            $code .= $suffix;
        }

        return $code;
    }
}