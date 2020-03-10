<?php

namespace App\Http\Middleware;

use App\Log;
use App\Event;
use \Illuminate\Http\Request;
use Closure;

class HasClass
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $passed = !Event::noclass(today()) || Reader::findbyname($request->f)->type == 'gate';
        if($passed) {
            return $next($request);
        }
        $events = Event::ongoing()->map(function($event) {
            return $event->title;
        })->join(', ');
        $sf = Student::findbyuid($request->i) ?? Faculty::findbyuid($request->i);
        $gr->logs->save($sf->logs()->create(['remarks' => 'denied', 'date' => today()]));
        abort(404, 'No classes for today! (' . $events . ')');
    }
}
