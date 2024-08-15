<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventStall;
use App\Models\EventTimeSlot;

class EventController extends Controller
{

    public function getEventData($eventId)
    {

        $timeSlots = EventTimeSlot::where('event_id', $eventId)->get();
        $stalls = EventStall::where('event_id', $eventId)->get();

        return response()->json(['timeSlots' => $timeSlots, 'stalls' => $stalls]);

    }


    public function event($id)
    {

        $event = Event::where('id', $id)->first();
        $timeSlot = EventTimeSlot::where('event_id', $id)->get();
        foreach ($timeSlot as $time) {
            $stalls = EventStall::where('event_id', $id)
                ->where('time_slot_id', $time->time_slot_id)
                ->get();
            $time->stalls = $stalls;
        }
        $stalls = EventStall::where('event_id', $id)
            ->where('time_slot_id', $timeSlot->first()->time_slot_id)
            ->get();

        return view('event_detail', compact('event', 'timeSlot', 'stalls'));
    }
}
