<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeLevelJoinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'     => $this['id'],
            'niveau' => $this['name'],
        ];

        if (isset($this['classes'])) {
            foreach ($this['classes'] as $classe)
                $data['classes'][] = [
                    'libelle' => $classe['name'],
                    'id'      => $classe['id']
                ];
        }

        return $data;
    }
}