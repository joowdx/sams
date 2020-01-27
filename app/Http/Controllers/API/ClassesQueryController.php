<?php

namespace App\Http\Controllers\API;

use App\AcademicPeriod;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\OngoingClasses;

class ClassesQueryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Course::whereIn('academic_period_id',
            AcademicPeriod::where(function($query) {
                $query->whereDate('start', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
            })->get()->map(function($period) {
                return $period->id;
            })->all()
        // )->with('room')->get();
        )->whereTime('time_from', '<=', date('H:i'))->whereTime('time_to', '>', date('H:i'))->get();

    }
}
