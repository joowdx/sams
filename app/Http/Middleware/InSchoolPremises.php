<?php

namespace App\Http\Middleware;

use App\Reader;
use App\Student;
use App\Faculty;

use \Illuminate\Http\Request;
use Closure;

class InSchoolPremises
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
        $reader = Reader::where(['name' => $request->f ?? '-1'])->first();
        if($reader->type == 'gate') {
            return $next($request);
        }
        $sf = Student::findbyuid($request->i) ?? Faculty::findbyuid($request->i);
        if($sf->entered()) {
            return $next($request);
        }
        abort(403, 'Not Allowed!');
    }
}
