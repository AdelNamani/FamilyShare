<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events=Event::where('id_Family','=',auth('api')->user()->id_family)->get();
        return $events;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $event->date = $request->date;
        $event->legend = $request->legend;
        $event->id_Family = auth('api')->user()->id_family;
        if($event->save()) return json_encode(['success' => 'Event created']); else return json_encode(['error' => 'Not created']);
    }
}


