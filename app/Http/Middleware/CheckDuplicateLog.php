<?php

namespace App\Http\Middleware;

use App\Course;
use App\Student;

use \Illuminate\Http\Request;
use Closure;

class CheckDuplicateLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $course = Course::findforattendance($request->f);
        $student = Student::findbyuid($request->i);
        return $next($request);
    }
}
