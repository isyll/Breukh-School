<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeLevelClasseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'   => $this->id,
            'name' => $this->name,
        ];

        if (isset($this['classes']))
            $data['classes'] = OnlyClasseResource::collection($this->classes);
        return $data;
    }
}