<?php

namespace App\Http\Controllers;

use \App\AcademicPeriod as Period;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('attendance', [
            'currentsemester' => Period::currentsemester(),
            'currentschoolyear' => Period::currentschoolyear(),
            'semesters' => Period::groupBy('semester')->get('semester')->pluck('semester'),
            'schoolyears' => Period::groupBy('school_year')->orderBy('school_year', 'desc')->get('school_year')->pluck('school_year'),
        ]);
    }
}
