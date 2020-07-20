<?php

namespace App\Http\Controllers\API;

use App\Event;
use App\AcademicPeriod;
use App\Course;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\OngoingClasses;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'id' => 'required_with:date|numeric|exists:courses',
            'date' => 'required_with:id|date_format:Y-m-d',
        ])->passes();

        abort_unless($validator, 403);

        switch ($validator && $request->id) {
            case true:
                $date = Carbon::create($request->date);
                $course = Course::find($request->id);
                $noclass = $course->noclass(Carbon::create($request->date));
                $response = [];
                if($noclass) {
                    $week = ['Mon' => 0, 'Tue' => 1, 'Wed' => 2, 'Thu' => 3, 'Fri' => 4, 'Sat' => 5, 'Sun' => 6,];
                    if(Event::noclass($date)) {
                        $response['events'] = Event::findbydate($date)->pluck('title');
                    }
                    if(!($week[$course->day_from] <= ($d  = $week[$date->format('D')]) && $week[$course->day_to] >= $d)) {
                        $response['schedule'] = "$course->day_from to $course->day_to; " . $date->format("D");
                    }
                    return $response;
                }
                return response()->json($noclass ? $response : $noclass);
            break;
            default:{
                return Course::with(['logs' => function($query) {
                    $query->whereDate('date', today())->where(['log_by_type' => 'App\Faculty']);
                }, 'logs.log_by', 'faculty'])->whereIn('academic_period_id',
                    AcademicPeriod::where(function($query) {
                        $query->whereDate('start', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
                    })->get()->map(function($period) {
                        return $period->id;
                    })->all()
                )->whereTime('time_from', '<=', date('H:i'))->whereTime('time_to', '>', date('H:i'))->with('room')->get();
            }
        }

    }
}
