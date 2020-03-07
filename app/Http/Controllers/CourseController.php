<?php

namespace App\Http\Controllers;

use App\AcademicPeriod as Period;
use App\Course;
use App\Faculty;
use App\Student;
use App\Reader;
use App\User;
use App\Log;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('rview', User::class);
        return view('courses.index', [
            'contentheader' => 'Courses',
            'courses' => Course::with(['faculty'])->get(),
            'current' => Course::currentcourses(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create', [
            'contentheader' => 'Create',
            'breadcrumbs' => [
                [
                    'text' => 'Courses',
                    'link' => route('courses.index'),
                ],
                [
                    'text' => 'Info'
                ]
            ],
            'faculties' => Faculty::all(),
            'students' => Student::all(),
            'rooms' => Reader::rooms(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|numeric|digits_between:0,7',
            'title' => 'required|string|max:10',
            'description' => 'required|string',
            'semester' => 'required|string|in:1ST,2ND,SUMMER',
            'term' => 'required|string|in:1ST,2ND,SEMESTER',
            'day_from' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'day_to' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'time_from' => 'required|string',
            'time_to' => 'required|string',
            'units' => 'required|string|numeric|digits:1',
            'reader_id' => 'nullable|string|numeric|exists:reader,id',
            'faculty_id' => 'nullable|string|numeric|exists:faculties,id',
        ]);
        Course::create($request->all());
        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($course = Course::find($id), 404);
        return view('courses.show', [
            'contentheader' => 'Course Info',
            'breadcrumbs' => [
                [
                    'text' => 'Courses',
                    'link' => route('courses.index'),
                ],
                [
                    'text' => 'Info',
                ]
            ],
            'course' => $course,
            'courses' => Course::with('students', 'logs')->get(),
            'logs' => Log::all(),
            'days' => $course->academic_period ? iterator_to_array(CarbonPeriod::create($course->academic_period->start, $course->academic_period->end)->filter(function($day) { return $day->isWeekDay(); })->map(function($day) { return $day->format('D d-m-y'); })) : [],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'))->with([
            'contentheader' => 'Edit',
            'breadcrumbs' => [
                [
                    'text' => 'Courses',
                    'link' => route('courses.index'),
                ],
                [
                    'text' => 'Info',
                    'link' => route('courses.show', $course->id),
                ],
                [
                    'text' => 'Edit',
                ],
            ],
            'students' => Student::all(),
            'faculties' => Faculty::all(),
            'rooms' => Reader::rooms(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {

        $request->validate([
            'type' => 'required|string|in:info,students',
            'code' => 'required_if:type,info|string|numeric|digits_between:0,7',
            'title' => 'required_if:type,info|string|max:10',
            'description' => 'required_if:type,info|string',
            'semester' => 'required_if:type,info|string|in:1ST,2ND,SUMMER',
            'term' => 'required_if:type,info|string|in:1ST,2ND,SEMESTER,SUMMER',
            'day_from' => 'required_if:type,info|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'day_to' => 'required_if:type,info|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'time_from' => 'required_if:type,info|string',
            'time_to' => 'required_if:type,info|string',
            'units' => 'required_if:type,info|string|numeric|digits:1',
            'reader_id' => 'nullable|string|numeric|exists:reader,id',
            'faculty_id' => 'nullable|string|numeric|exists:faculties,id',
            'students' => 'nullable|array',
            'students.*' => 'numeric|exists:students,id',
        ]);

        switch($request->type) {
            case 'info': {
                $ap = Period::firstOrCreate([
                    'semester' => $request->semester,
                    'term' => $request->semester == 'SUMMER' ? 'SUMMER' : $request->term,
                ]);
                $course->update($request->all());
                $course->academic_period()->associate($ap);
                $course->save();
                break;
            }
            case 'faculty': {
                $course->update(['faculty_id', $request->faculty_id]);
                break;
            }
            case 'students': {
                $course->students()->sync($request->students);
                break;
            }
        }

        return redirect(route('courses.show', $course->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
