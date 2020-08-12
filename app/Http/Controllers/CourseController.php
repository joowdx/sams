<?php

namespace App\Http\Controllers;

use App\AcademicPeriod as Period;
use App\Course;
use App\Faculty;
use App\Student;
use App\Reader;
use App\User;
use App\Log;
use App\Program;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $course = null;
        // $user = Auth::user();
        // $user = Auth::user();
        // if($user->faculty && $user->type != 'admin') {
        //     $courses = $user->faculty->courses();
        // }
        $user = Auth::user();
        $courses = Course::with(['faculty'])->get();
        $ccourses = Course::currentcourses();
        if($user->type == 'faculty') {
            $courses = $courses->filter(function($course) use($user) {
                return $user->faculty->courses->contains($course->id);
            });
            $ccourses = $ccourses->filter(function($course) use($user) {
                return $user->faculty->courses->contains($course->id);
            });
        }
        return view('courses.index', [
            'contentheader' => 'Courses',
            'courses' => $courses,
            'current' => $ccourses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('courses_data', User::class);
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
            'periods' => Period::all(),
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
        $this->authorize('courses_data', User::class);
        $request->validate([
            'code' => 'required|string|numeric|digits_between:0,7',
            'title' => 'required|string|max:10',
            'description' => 'required|string',
            // 'semester' => 'required|string|in:1ST,2ND,SUMMER',
            // 'term' => 'required|string|in:1ST,2ND,SEMESTER',
            'day_from' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'day_to' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'time_from' => 'required|string',
            'time_to' => 'required|string',
            'units' => 'required|string|numeric|digits:1',
            'room_id' => 'nullable|string|numeric|exists:readers,id',
            'faculty_id' => 'nullable|string|numeric|exists:faculties,id',
            'academic_period_id' => 'required',
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
        // dd(Student::whereHas('logs', function($query) use($id) {
        //     $query->where('course_id', $id);
        //     $query->where('remarks', 'absent');
        // }, '>', 3)->with(['logs' => function($query) use($id) {
        //     $query->where('course_id', $id);
        //     $query->where('remarks', 'absent');
        // }, 'courses' => function($query) use($id) {
        //     $query->where('id', -1);
        // }])->get()->toArray());
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
            'logs' => Log::all(),
            'drops' => $drops = Student::whereHas('logs', function($query) use($id) {
                $query->where('course_id', $id);
                $query->where('remarks', 'absent');
            }, '>', $course->getdroprate())->with(['logs' => function($query) use($id) {
                $query->where('course_id', $id);
                $query->where('remarks', 'absent');
            }])->get(),
            'dropcandidates' => Student::whereHas('logs', function($query) use($id) {
                $query->where('course_id', $id);
                $query->where('remarks', 'absent');
            }, '>', $course->getdroprate() * 0.75)->with(['logs' => function($query) use($id) {
                $query->where('course_id', $id);
                $query->where('remarks', 'absent');
            }])->whereNotIn('id', $drops->pluck('id'))->get(),
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
        $this->authorize('courses_data', User::class);
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
            'periods' => Period::all(),
            'rooms' => Reader::rooms(),
            'course' => $course
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
        $this->authorize('courses_data', User::class);
        $request->validate([
            'type' => 'required|string|in:info,students,faculty',
            'code' => 'required_if:type,info|string|numeric|digits_between:0,7',
            'title' => 'required_if:type,info|string|max:10',
            'description' => 'required_if:type,info|string',
            // 'semester' => 'required_if:type,info|string|in:1ST,2ND,SUMMER',
            // 'term' => 'required_if:type,info|string|in:1ST,2ND,SEMESTER,SUMMER',
            'day_from' => 'required_if:type,info|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'day_to' => 'required_if:type,info|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'time_from' => 'required_if:type,info|string',
            'time_to' => 'required_if:type,info|string',
            'units' => 'required_if:type,info|string|numeric|digits:1',
            'room_id' => 'nullable|string|numeric|exists:readers,id',
            'faculty_id' => 'nullable|string|numeric|exists:faculties,id',
            'students' => 'nullable|array',
            'students.*' => 'numeric|exists:students,id',
            'academic_period_id' => 'required_if:type,info|numeric|exists:academic_periods,id',
        ]);

        switch($request->type) {
            case 'info': {
                // $ap = Period::firstOrCreate([
                //     'semester' => $request->semester,
                //     'term' => $request->semester == 'SUMMER' ? 'SUMMER' : $request->term,
                // ]);
                $course->update($request->all());
                // $course->academic_period()->associate($ap);
                // dd($course);
                $course->save();
                break;
            }
            case 'faculty': {
                $course->update(['faculty_id' => $request->faculty_id]);
                // $course->faculty()->associate($request->faculty_id);
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
        $this->authorize('courses_data', User::class);
        $course->delete();

        return redirect('courses');
    }
}
