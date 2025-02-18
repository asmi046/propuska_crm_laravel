<?php

namespace App\Http\Controllers;

use App\Models\CheckEvent;
use Illuminate\Http\Request;
use App\Filters\EventsFilter;

class EventLogController extends Controller
{
    public function index() {
        return view('event_log');
    }

    public function get_event_list(EventsFilter $request) {
        $events = CheckEvent::with('truc')->filter($request)->get();
        return $events;
    }

    public function set_event_state(Request $request) {
        $list = $request->input('list');
        $state = $request->input('state');

        $result = CheckEvent::whereIn('id', $list)->update(['state' => $state]);

        return [$result];
    }
}
