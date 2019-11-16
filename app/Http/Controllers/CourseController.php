<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;
use App\User;
use App\Log;
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

        return view('courses.index')->with([
            'contentheader' => 'Courses',
            'courses' => Course::with(['faculty'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create')->with([
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
            'time_from' => 'required|string|numeric',
            'time_to' => 'required|string|numeric',
            'units' => 'required|string|numeric|digits:1',
            'room_id' => 'nullable|string|numeric|exists:room,id',
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
    public function show(Course $course)
    {
        return view('courses.show', compact('course'))->with([
            'contentheader' => 'Course Info',
            'courses' => Course::with('students')->get(),
            'students' => Student::all(),
            'logs' => Log::all(),
            'breadcrumbs' => [
                [
                    'text' => 'Courses',
                    'link' => route('courses.index'),
                ],
                [
                    'text' => 'Info'
                ]
            ]
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
                    'text' => 'Info'
                ]
            ],
            'students' => Student::all(),
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
            'term' => 'required_if:type,info|string|in:1ST,2ND,SEMESTER',
            'day_from' => 'required_if:type,info|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'day_to' => 'required_if:type,info|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'time_from' => 'required_if:type,info|string|numeric',
            'time_to' => 'required_if:type,info|string|numeric',
            'units' => 'required_if:type,info|string|numeric|digits:1',
            'room_id' => 'nullable|string|numeric|exists:room,id',
            'faculty_id' => 'nullable|string|numeric|exists:faculties,id',
            'students' => 'required_if:type,students|array',
            'students.*' => 'numeric|exists:students,id',
        ]);

        switch($request->type) {
            case 'info': {
                $course->update($request->all());
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
