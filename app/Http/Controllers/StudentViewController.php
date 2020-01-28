<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AcademicPeriod;
use App\Course;
use App\Faculty;
use App\Student;
use App\User;
use App\Log;
use Carbon\CarbonPeriod;

class StudentViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('studentview.index')->with([
            'contentheader' => 'Attendance Record',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(Student $student, Course $course)
    {
        return view('studentview.show', compact('student'))->with([
            'contentheader' => 'Course Info',
            'students'      => Student::with('courses')->get(),
            'courses'       => Course::with('students', 'logs')->get(),
            'logs'          => Log::all(),
            'days'          => $course->academic_period ? iterator_to_array(CarbonPeriod::create($course->academic_period->start, $course->academic_period->end)->filter(function($day) { return $day->isWeekDay(); })->map(function($day) { return $day->format('D d-m-y'); })) : [],
            'breadcrumbs'   => [
                [
                    'text' => 'Courses',
                    'link' => route('courses.index'),
                ],
                [
                    'text' => 'Info',
                ]
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
