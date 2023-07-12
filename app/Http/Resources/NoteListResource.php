<?php

namespace App\Http\Resources;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'student'   => $this['id'],
            'firstname' => $this['firstname'],
            'lastname'  => $this['lastname'],
            'notes'     => $this['notes']
        ];
    }
}