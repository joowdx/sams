<?php

namespace App\Http\Controllers\API;

use App\Log;
use App\Course;
use App\Student;
use App\Faculty;
use App\AcademicPeriod as Period;
use App\Department;
use App\Program;
use App\Http\Resources\ChartStatistics;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Statistics extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        abort_unless(($x = \Validator::make($request->all(), [
            'schoolyear' => 'nullable|regex:/\d{4}-\d{4}/|required_with:semester',
            'semester' => 'nullable|in:1ST,2ND,SUM|required_with:schoolyear',
            'level' => 'nullable|in:department,program',
        ]))->passes(), 400, $x->errors());

        abort_unless(!$request->has('schoolyear') || explode('-', $request->schoolyear)[1] - explode('-', $request->schoolyear)[0] == 1, 400, 'Bad request');

        $courses = Course::whereIn('academic_period_id', Period::period($request->schoolyear, $request->semester))->get();

        $students = Student::whereIn('id', $courses->flatMap(function($course) {
            return $course->students;
        })->pluck('id')->unique())->with(['courses' => function($query) use($courses) {
            $query->whereIn('id', $courses->pluck('id'));
        }])->get();

        switch($request->level) {
            default: {
                $statistics = [];
                foreach(Department::all() as $department) {
                    $x = $statistics[] = $department;
                    $x->students = $students->filter(function($student) use($department) {
                        return @$student->program->department->id == @$department->id;
                    });
                }
                return new ChartStatistics($statistics);
            }
            case 'program': {
                $statistics = [];
                foreach(Program::all() as $program) {
                    $x = $statistics[] = $program;
                    $x->students = $students->filter(function($student) use($program) {
                        return @$student->program->id == @$program->id;
                    });
                }
                return new ChartStatistics($statistics);

            }
        }

    }
}
