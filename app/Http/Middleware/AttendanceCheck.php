<?php

namespace App\Http\Middleware;

use App\Course;

use \Illuminate\Http\Request;
use Closure;

class AttendanceCheck
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
        $passed = Course::findforattendance($request->f);
        if($passed) {
            return $next($request);
        }
        abort(403, 'Attendance is now disabled.');
    }

    private function handlecheck(Request $request)
    {

    }
}
