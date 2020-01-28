<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\Course;
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
        return view('students.index')->with([
            'contentheader' => 'Students',
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

        $student = new Student();
        return view('students.create', compact('student'));
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

        Student::create($request->all());

        return redirect('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student){

        $students = new Student();
        // var_dump($students->showStudentDetails($student->uid));
        return view('students.show', [
            'contentheader' => 'Student Info',
            'studentDetails' => $students->showStudentDetails($student->uid),
            'student' => $student,
            'breadcrumbs' => [
                [
                    'text' => 'Students',
                    'link' => route('students.index'),
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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'))->with([
            'contentheader' => 'Update student',
            'breadcrumbs' => [
                [
                    'text' => 'Students',
                    'link' => route('students.index'),
                ],
                [
                    'text' => 'Edit'
                ]
            ]
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

        $student = Student::findorfail($id);
        $student->uid   =   $request->uid;
        $student->name  =   $request->name;
        $student->save();

        return redirect('students');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $this->authorize('delete', User::class);

        $student->delete();

        return redirect('students');
    }
}
