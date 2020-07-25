<?php

namespace App\Http\Controllers;

use App\Program;
use App\Faculty;
use App\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('programs_data', User::class);

        $user = Auth::user();
        if($user->type == 'faculty') {
            if($user->faculty->isdepartmenthead()) {
                $programs = Program::whereIn('id', $user->faculty->program->department->programs->pluck('id'))->get();
            } elseif ($user->faculty->isprogramhead()) {
                $programs = Program::where('id', $user->faculty->program->id)->get();
            }
        } else {
            $programs = Program::all();
        }

        return view('programs.index', [
            'contentheader' => 'Programs',
            'programs' => $programs->load([
                'faculty',
                'students',
                'students.courses',
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('programs_data', User::class);

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
        $this->authorize('programs_data', User::class);

        $request->validate([
            'name' => 'required|string|unique:programs,name',
            'shortname' => 'required|string|max:20|unique:programs,shortname',
            'department_id' => 'required|string|numeric|exists:departments,id',
            'faculty_id' => 'sometimes|nullable|exists:faculties,id',
        ]);
        $program = Program::create($request->all());
        // $program->department()->associate($program->faculty->department);
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
        $this->authorize('programs_data', User::class);

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
        $this->authorize('programs_data', User::class);

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
            'departments' => Department::all()
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
        $this->authorize('programs_data', User::class);

        $request->validate([
            'name' => 'required|string|unique:programs,name,'.$id,
            'shortname' => 'required|string|max:20|unique:programs,name,'.$id,
            'department_id' => 'required|string|numeric|exists:departments,id',
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
        $this->authorize('programs_data', User::class);

        abort_unless(is_numeric($id), 404);
        abort_unless($program = Program::find($id), 404);
        $program->delete();
        return redirect(route('programs.index'));
    }
}
