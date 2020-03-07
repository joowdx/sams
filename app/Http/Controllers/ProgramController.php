<?php

namespace App\Http\Controllers;

use App\Program;
use App\Faculty;
use App\Department;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs.index', [
            'contentheader' => 'Programs',
            'programs' => Program::with([
                'faculty',
                'students',
                'students.courses',
            ])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.create', [
            'contentheader' => 'Create',
            'breadcrumbs' => [
                [
                    'text' => 'Programs',
                    'link' => route('programs.index'),
                ],
                [
                    'text' => 'Create'
                ]
            ],
            'faculties' => Faculty::all(),
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
        $request->validate([
            'name' => 'required|string|unique:programs,name',
            'shortname' => 'required|string|max:20|unique:programs,shortname',
            'faculty_id' => 'sometimes|exists:faculties,id',
        ]);
        $program = Program::create($request->all());
        $program->department()->associate($program->faculty->department);
        return redirect(route('programs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($program = Program::find($id)->load([
            'faculty',
            'faculty.program',
            'faculty.program',
            'faculty.courses',
            'students',
            'students.program',
            'students.program.department',
        ]), 404);
        return view('programs.show', [
            'contentheader' => $program->shortname,
            'breadcrumbs' => [
                [
                    'text' => 'Programs',
                    'link' => route('programs.index'),
                ],
                [
                    'text' => $program->shortname
                ]
            ],
            'program' => $program,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($program = Program::find($id), 404);
        return view('programs.edit', [
            'contentheader' => 'Edit',
            'breadcrumbs' => [
                [
                    'text' => 'Program',
                    'link' => route('programs.index'),
                ],
                [
                    'text' => $program->shortname,
                    'link' => route('programs.show', $program->id),
                ],
                [
                    'text' => 'Edit',
                ]
            ],
            'program' => $program,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:programs,name,'.$id,
            'shortname' => 'required|string|max:20|unique:programs,name,'.$id,
            'faculty_id' => 'sometimes|exists:faculties,id',
        ]);
        Program::find($id)->update($request->all());
        return redirect(route('programs.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($department = Department::find($id), 404);
        $department->delete();
        return redirect(route('departments.index'));
    }
}
