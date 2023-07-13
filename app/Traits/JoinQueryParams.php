<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait JoinQueryParams
{
    private function joinQueryParams(Request $request)
    {
        $joinParams = $request->input('join');
        if (!$joinParams)
            return [];

        return array_map(function ($item) {
            return trim(preg_replace('/\s+/', ' ', $item));
        }, array_filter(explode(',', $joinParams), function ($item) {
            return trim($item) != '';
        }));
    }

    private function runQueryRelations(
        Request $request,
        string $model,
        array $relations,
        int $id,
        string $resource = null
    ) {
        $joinParams = $this->joinQueryParams($request);
        $builder    = $model::where('id', $id);

        foreach ($joinParams as $joinParam) {
            if (array_key_exists($joinParam, $relations))
                $builder = $builder->with($relations[$joinParam]);
            else
                return response()->json([
                    'errors' => [__('messages.relation_not_found', ['relation' => $joinParam])]
                ]);
        }

        $builder = $builder->first();

        if ($resource !== null)
            return $resource::make($builder->toArray());
        return $builder;
    }
}