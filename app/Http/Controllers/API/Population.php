<?php

namespace App\Http\Controllers\API;


use App\Course;
use App\Student;
use App\Faculty;
use App\AcademicPeriod as Period;
use App\Department;
use App\Program;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Population extends Controller
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
        }])->with('program')->get();

        $levels = $request->level == 'department' ? Department::all() : Program::all();
        foreach ($levels as $level) {
            @$data[] = $students->filter(function($student) use($level, $request) {
                return ($request->level == 'department' ? $student->program->department->id : $student->program->id) == $level->id;
            })->count();
        }
        return response()->json([
            'labels' => $levels->pluck('shortname'),
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => $data,
                ],
            ],
        ]);
    }
}
