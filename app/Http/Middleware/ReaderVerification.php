<?php

namespace App\Http\Middleware;

use App\UnknownLog;
use App\Reader;
use App\Helpers\CommonHelper as CH;

use \Illuminate\Http\Request;
use Closure;

class ReaderVerification
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
        $reader = Reader::findbyname($request->f);
        $nullip = $reader ? ($reader->ip ? false : true) : null;
        $passed = @$reader->ip == $request->ip();
        if($passed || $nullip) {
            return $next($request);
        }
        UnknownLog::create([
            'uid' => $request->i,
            'from' => $request->f,
            'ip' => $request->ip(),
            'method' => $request->method(),
            'data' => $request->all(),
            'remarks' => $reader ? 'ip mismatch' : 'unknown location',
        ]);
        abort(404, 'Unknown Location');
    }
}
