<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Student;
use App\Department;
use App\AcademicPeriod as Period;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('fview', User::class);
        return view('students.index', [
            'contentheader' => 'Students',
            'students' => Student::all(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('students.create', [
            'contentheader' => 'Create',
            'breadcrumbs' => [
                [
                    'text' => 'Students',
                    'link' => route('students.index'),
                ],
                [
                    'text' => 'Create'
                ]
            ],
            'departments' => Department::all(),
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
        $this->authorize('create', User::class);
        $request->validate([
            'uid' => 'sometimes|numeric|unique:students,uid',
            'schoolid' => 'sometimes|numeric|unique:students,schoolid',
            'name' => 'required|string',
            'department_id' => 'sometimes|exists:departments,id',
        ]);
        Student::create($request->all());
        return redirect('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($student = Student::find($id), 404);
        return view('students.show', [
            'contentheader' => $student->name,
            'breadcrumbs' => [
                [
                    'text' => 'Students',
                    'link' => route('students.index'),
                ],
                [
                    'text' => $student->name
                ]
            ],
            'student' => $student,
            'currentsemester' => Period::currentsemester(),
            'currentschoolyear' => Period::currentschoolyear(),
            'semesters' => Period::groupBy('semester')->get('semester')->pluck('semester'),
            'schoolyears' => Period::groupBy('school_year')->orderBy('school_year', 'desc')->get('school_year')->pluck('school_year'),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($student = Student::find($id), 404);
        return view('students.edit', [
            'contentheader' => 'Edit',
            'breadcrumbs' => [
                [
                    'text' => 'Students',
                    'link' => route('students.index'),
                ],
                [
                    'text' => $student->name,
                    'link' => route('students.show', $student->id),
                ],
                [
                    'text' => 'Edit'
                ],
            ],
            'student' => $student,
            'departments' => Department::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', User::class);
        $request->validate([
            'id' => 'required|numeric|exists:students,id',
            'uid' => 'sometimes|numeric|unique:students,uid,'.$id,
            'schoolid' => 'sometimes|numeric|unique:students,schoolid,'.$id,
            'name' => 'required|string',
            'department_id' => 'sometimes|exists:departments,id',
        ]);
        Student::find($id)->update($request->all());
        return redirect('students');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);
        abort_unless(is_numeric($id), 404);
        abort_unless($department = Student::find($id), 404);
        $student->delete();
        return redirect('students');
    }
}
