<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\User;
use App\Course;
use App\Student;
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
            'contentheader' => 'Faculty Info',
            'courses'   => Course::with('faculty')->where('faculty_id',$faculty->id)->get(),
            'students'  => Student::all(),
            'breadcrumbs' => [
                [
                    'text' => 'Faculties',
                    'link' => route('faculties.index'),
                ],
                [
                    'text' => 'Info'
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
