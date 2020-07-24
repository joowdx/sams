<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Student;
use App\Department;
use App\AcademicPeriod as Period;
use App\Program;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('faculty_view', User::class);

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
        $this->authorize('students_data', User::class);
        $user = Auth::user();
        if($user->type == 'faculty') {
            $programs = Program::all()->filter(function($program) use($user) {
                if(@$user->faculty->isdepartmenthead()) {
                    return @$program->department->name == @$user->faculty->department->shortname;
                }
                return @$program->shortname == @$user->faculty->program->shortname;
            });
        }
        else {
            $programs = Program::all();
        }
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
            'programs' => $programs,
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
        $this->authorize('students_data', User::class);
        $request->validate([
            'uid' => 'sometimes|nullable|string|unique:students,uid',
            'schoolid' => 'sometimes|numeric|unique:students,schoolid',
            'name' => 'required|string',
            'program_id' => 'sometimes|exists:programs,id',
        ]);
        $student = Student::create($request->all());
        if(request()->hasFile('avatar'))
        {
            $avatar = request()->file('avatar')->getClientOriginalExtension();
            $file = $student->name.".".$avatar;
            request()->file('avatar')->storeAs('public/avatars', '' . '/' . $file, '');
            $student->update(['avatar' => $file]);
        }
        return redirect('students');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $sy = Period::currentschoolyear();
        // $sm = Period::currentsemester();
        // $ap = Period::where('school_year', $sy)->where('semester', $sm)->get('id')->pluck('id');
        // $qwe = Student::find($id)->load(['courses' => function($query) use($ap) {
        //     $query->whereIn('academic_period_id', $ap);
        // }, 'courses.logs', 'courses.logs.course'])->courses->flatMap(function($courses) {
        //      $courses->logs;
        // });
        abort_unless(is_numeric($id), 404);
        abort_unless($student = Student::find($id)->load(['logs', 'logs.course']), 404);
        abort_unless($student = Student::find($id)->load([
            'program', 'program.department'
        ]), 404);
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
            'logs' => Log::all()
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
        $this->authorize('students_data', User::class);
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
            'programs' => Program::all()
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
        $this->authorize('students_data', User::class);
        $request->validate([
            'uid' => 'sometimes|string|unique:students,uid,'.$id,
            'schoolid' => 'sometimes|numeric|unique:students,schoolid,'.$id,
            'name' => 'required|string',
            'department_id' => 'sometimes|exists:departments,id',
        ]);
        $student = Student::find($id);
        $student->update($request->all());

        if(request()->hasFile('avatar'))
        {
            $avatar = request()->file('avatar')->getClientOriginalExtension();
            $file = $student->name.".".$avatar;
            request()->file('avatar')->storeAs('public/avatars', '' . '/' . $file, '');
            $student->update(['avatar' => $file]);

        }
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
        $this->authorize('students_data', User::class);
        abort_unless(is_numeric($id), 404);
        abort_unless($student = Student::find($id), 404);
        $student->delete();
        return redirect('students');
    }

    public function authenticate()
    {
        return view('auth.studentlogin');
    }
}
