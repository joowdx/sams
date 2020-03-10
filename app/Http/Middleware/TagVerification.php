<?php

namespace App\Http\Middleware;

use App\UnknownLog;
use App\Student;
use App\Faculty;
use App\Helpers\CommonHelper as CH;

use \Illuminate\Http\Request;
use Closure;

class TagVerification
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
        $passed = Student::findbyuid($request->i) ?? Faculty::findbyuid($request->i);
        if($passed) {
            return $next($request);
        }
        UnknownLog::create([
            'uid' => $request->i,
            'from' => $request->f,
            'ip' => $request->ip(),
            'method' => $request->method(),
            'data' => $request->all(),
            'remarks' => 'unknown tag'
        ]);
        abort(404, 'Unknown Tag');
    }
}
