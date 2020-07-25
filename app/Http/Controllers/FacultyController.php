<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\User;
use App\Course;
use App\Program;
use App\Student;
use App\AcademicPeriod as Period;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return Auth::user()->faculty;
        // if($user->faculty && $user->type != 'admin') {
        //     if($user->faculty->isdepartmenthead()) {
        //         $faculties = @Program::where(['department_id' => $user->faculty->department->id])->with(['faculties', 'faculties.courses', 'faculties.program', 'faculties.program.department'])->get()->pluck('faculties')[0];
        //     } else if($user->faculty->isprogramhead()) {
        //         $faculties = Faculty::with(['courses', 'program', 'program.department'])->where(['program_id' => $user->id])->get();
        //     }
        // }
        // return $faculties;
        $this->authorize('faculties_view', User::class);

        $user = Auth::user();
        if($user->type == 'faculty') {
            if($user->faculty->isdepartmenthead()) {
                $faculties = Faculty::whereIn('program_id', $user->faculty->program->department->programs->pluck('id'))->get();
            } elseif ($user->faculty->isprogramhead()) {
                $faculties = Faculty::where('program_id', $user->faculty->program->id)->get();
                // dd($faculties->toArray());
            }
        }
        return view('faculties.index')->with([
            'contentheader' => 'Faculties',
            'faculties' => $faculties ?? Faculty::with(['courses', 'program'])->get(),
            'currentsemester' => Period::currentsemester(),
            'currentschoolyear' => Period::currentschoolyear(),
            'semesters' => Period::groupBy('semester')->get('semester')->pluck('semester'),
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

        $this->authorize('faculties_data', User::class);

        $user = Auth::user();
        if($user->type == 'faculty') {
            if($user->faculty->isdepartmenthead()) {
                $programs = Program::whereIn('id', $user->faculty->program->department->programs->pluck('id'))->get();
            }elseif ($user->faculty->isprogramhead()) {
                $programs = Program::where('id', $user->faculty->program->id)->get();
            }
        }
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
            'programs' => $programs ?? Program::all(),
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
        $this->authorize('faculties_data', User::class);

        $request->validate([
            'uid' => 'nullable|string',
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
            'contentheader' => 'Faculty',
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
        $this->authorize('faculties_data', User::class);
        $user = Auth::user();
        if($user->type == 'faculty') {
            if($user->faculty->isdepartmenthead()) {
                $programs = Program::whereIn('id', $user->faculty->program->department->programs->pluck('id'))->get();
            }elseif ($user->faculty->isprogramhead()) {
                $programs = Program::where('id', $user->faculty->program->id)->get();
            }
        }
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
            'programs' => $program ?? Program::all()
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
        $this->authorize('faculties_data', User::class);

        $request->validate([
            'type' => 'required|string|in:info,courses',
            'uid' => 'nullable|string',
            'program_id' => 'required|exists:programs,id',
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
    public function destroy($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($faculty = Faculty::find($id), 404);
        $this->authorize('faculties_data', User::class);

        $this->authorize('delete', User::class);


        $faculty->delete();

        return redirect('faculties');
    }
}
