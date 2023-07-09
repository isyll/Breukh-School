<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Classe;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function all()
    {
        return EventResource::collection(Event::all());
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();

        $event          = new Event;
        $event->name    = $data['name'];
        $event->date    = $data['date'];
        $event->user_id = $data['user'];
        $event->save();

        return $event;
    }

    public function addParticipations(Request $request, Event $event)
    {
        $data = $request->input('classes');
        if (!is_array($data)) {
            return response()->json([
                'errors' => [__('messages.input_format_is_invalid')]
            ], 422);
        }
        $results = [];

        foreach ($data as $d) {
            $classe = Classe::where('id', $d)->with('events')->first();
            if (!$classe) {
                return response()->json([
                    'errors' => [
                        __('messages.class_does_not_exists', [
                            'class_name' => $d
                        ])
                    ]
                ], 422);
            }

            $exists = false;
            foreach ($classe->events as $classe_event) {
                if ($classe_event->id == $event->id) {
                    $exists = true;
                    break;
                }
            }

            if ($exists)
                continue;
            $classe->events()->save($event);
            $results[] = $classe;
        }

        return $results;
    }
}