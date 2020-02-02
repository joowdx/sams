<?php

namespace App\Http\Controllers;

use App\Course;
use App\Faculty;
use Illuminate\Http\Request;

class FacultyCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Faculty $faculty)
    {
        return view('faculties.courses.index', compact('faculty'))->with([
            'contentheader' => "$faculty->name's Courses",
            'breadcrumbs' => [
                [
                    'text' => 'Faculties',
                    'link' => route('faculties.index'),
                ],
                [
                    'text' => $faculty->name,
                    'link' => route('faculties.show', $faculty->id),
                ],
                [
                    'text' => 'Courses'
                ]
            ],
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
    public function show(Faculty $faculty, Course $course)
    {
        abort_unless($faculty->courses->contains($course), 404);
        return view('faculties.courses.show', compact('faculty'))->with([
            'contentheader' => "$course->title($course->code)",
            'courses'   => $faculty->ongoingcourses(),
            'students' => $faculty->students(),
            'breadcrumbs' => [
                [
                    'text' => 'Faculties',
                    'link' => route('faculties.index'),
                ],
                [
                    'text' => $faculty->name,
                    'link' => route('faculties.show', $faculty->id),
                ],
                [
                    'text' => 'Courses',
                    'link' => route('faculties.courses.index', $faculty->id),
                ],
                [
                    'text' => "$course->title($course->code)",
                    // 'link' => route('faculties.courses.show', [$faculty->id, $course->id]),
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
