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
        $events = CheckEvent::with('truc')
            ->whereIn('event_name', ['До окончания пропуска осталось 60 дней', 'До окончания пропуска осталось 30 дней'])
            ->orderBy('created_at')
            ->filter($request)
            ->get();
        return $events;
    }

    public function set_event_state(Request $request) {
        $list = $request->input('list');
        $state = $request->input('state');

        if ($state === "Важное")
            $result = CheckEvent::whereIn('id', $list)->update(['important' => true]);
        elseif ($state === "Неважное")
            $result = CheckEvent::whereIn('id', $list)->update(['important' => false]);
        else
            $result = CheckEvent::whereIn('id', $list)->update(['state' => $state]);

        return [$result];
    }
}
