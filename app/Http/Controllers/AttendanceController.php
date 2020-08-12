<?php

namespace App\Http\Controllers;

use App\Log;
use App\Faculty;
use App\Course;
use App\AcademicPeriod as Period;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

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
        $this->authorize('attendance_view', Auth::user());
        abort_unless($request->isMethod('get'), 404, 'Not Found!');
        $content = [
            'contentheader' => 'Attendance',
            'currentsemester' => Period::currentsemester(),
            'currentschoolyear' => Period::currentschoolyear(),
            'semesters' => Period::groupBy('semester')->get('semester')->pluck('semester'),
            'schoolyears' => Period::groupBy('school_year')->orderBy('school_year', 'desc')->get('school_year')->pluck('school_year'),
            'faculties' => Faculty::findteaching(),
        ];
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'schoolyear' => 'required',
            'semester' => 'required|in:1ST,2ND,SUMMER',
            'faculty' =>  'nullable|exists:faculties,id'
        ]);
        if($validator->passes()) {
            $period = Period::where('school_year', $request->schoolyear)->where('semester', env('DB_CONNECTION') == 'pgsql' ? 'ilike' : 'like', "%$request->semester%")->get()->pluck('id');
            $courses = Course::whereIn('academic_period_id', $period)->get();
            // dd($courses->toArray());
            $logs = Log::whereIn('course_id', $courses->pluck('id'));
            $logs->where('log_by_type', Faculty::class);
            $logs->whereIn('remarks', [ 'ok', 'late', 'excuse', 'absent', 'leave']);
            $logs->whereDate('date', Carbon::createFromFormat('Y/m/d', $request->date));
            if($request->faculty) {
                $logs->where('log_by_id', $request->faculty);
                $content['faculty'] = @$logs->first()->log_by;
            } else {
                $logs->whereIn('log_by_id', $courses->unique('faculty_id')->pluck('faculty_id'));
            }
            // dd($logs->get()->toArray());
            $content['records'] = $logs->get()->load('modified_by');
            // dd($logs->get()->load('modified_by')->toArray());
            $content['schoolyear'] = $request->schoolyear;
            $content['semester'] = $request->semester;
            $content['date'] = $request->date;
        }
        return view('attendance', $content);
    }
}
