<?php

namespace App\Http\Controllers\API;

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
                return response()->json(Course::find($request->id)->noclass(Carbon::create($request->date)));
            break;
            default:{
                return Course::whereIn('academic_period_id',
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
