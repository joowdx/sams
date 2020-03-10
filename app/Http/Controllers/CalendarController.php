<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class CalendarController extends Controller
{
    public function __invoke() {
        return view('calendar')->with([
            'ongoing' => ($ongoing = Event::ongoing()) ?? [],
            'upcoming' => Event::upcoming(($count = 5 - $ongoing->count()) < 0 ? 1 :$count) ?? [],
        ]);
    }
}
