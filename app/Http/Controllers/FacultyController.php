<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\User;
use App\Course;
use App\Student;
use App\AcademicPeriod as Period;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('hview', User::class);
        return view('faculties.index')->with([
            'contentheader' => 'Faculties',
            'faculties' => Faculty::with(['courses', 'department'])->get(),
            'semester' => Period::groupBy('semester')->orderBy('semester', 'desc')->get('semester')->pluck('semester'),
            'schoolyears' => Period::groupBy('school_year')->orderBy('school_year', 'desc')->get('school_year')->pluck('school_year'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculties.create')->with([
            'contentheader' => 'New faculty',
            'breadcrumbs' => [
                [
                    'text' => 'Faculties',
                    'link' => route('faculties.index'),
                ],
                [
                    'text' => 'Create'
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
            'uid' => 'required|string|numeric',
            'name' => 'required|string',
        ]);
        Faculty::create($request->all());
        return redirect(route('faculties.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        return view('faculties.show', compact('faculty'))->with([
            'contentheader' => $faculty->name,
            'courses'   => $faculty->ongoingcourses(),
            'students' => $faculty->students(),
            'breadcrumbs' => [
                [
                    'text' => 'Faculties',
                    'link' => route('faculties.index'),
                ],
                [
                    'text' => $faculty->name
                ]
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        return view('faculties.edit', compact('faculty'))->with([
            'contentheader' => $faculty->name,
            'courses' => Course::all(),
            'breadcrumbs' => [
                [
                    'text' => 'Faculties',
                    'link' => route('faculties.index'),
                ],
                [
                    'text' => 'Info'
                ],
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'type' => 'required|string|in:info,courses',
            'uid' => 'required_if:type,info|string|numeric',
            'name' => 'required_if:type,info|string',
            'courses' => 'required_if:type,courses|array',
            'courses.*' => 'numeric|exists:courses,id',
        ]);
        switch($request->type) {
            case 'info': {
                $faculty->update($request->all());
                break;
            }
            case 'courses': {
                $faculty->courses()->whereNotIn('id', $request->courses)->update(['faculty_id' => null]);
                $faculty->courses()->saveMany(Course::findMany($request->courses));
                break;
            }
        }
        return redirect(route('faculties.show', $faculty->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $faculty)
    {
        $this->authorize('delete', User::class);


        $faculty->delete();

        return view('faculties.index', compact('faculty'));
    }
}
