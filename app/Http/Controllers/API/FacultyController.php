<?php

namespace App\Http\Controllers\API;

use App\AcademicPeriod as Period;
use App\Course;
use App\Faculty;
use App\Http\Resources\FacultyAttendanceForCalendar as FacultyAttendance;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(
            Validator::make($request->all(), [
                'schoolyear' => 'required_with:semester',
                'semester' => 'required_with:schoolyear'
            ])->passes(), 404
        );
        $schoolyear = $request->schoolyear ??  Period::currentschoolyear();
        $semester =  $request->semester ?? Period::currentsemester();
        $period = Period::where('school_year', $schoolyear)->where('semester', 'like', "%$semester%")->get()->pluck('id');
        return FacultyAttendance::collection(Faculty::with([
            'logs',
            'logs.course',
            'logs.log_by',
            'courses' => function($query) use($schoolyear, $semester, $period) {
                $query->whereIn('academic_period_id', $period);
            },
            'courses.faculty',
            'courses.logs' => function($query) {
                $query->where('log_by_type', 'App\Faculty');
            },
        ])->get()->filter(function($faculty) { return $faculty->courses->count(); } ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
