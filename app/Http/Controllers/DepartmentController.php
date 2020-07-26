<?php

namespace App\Http\Controllers;

use App\Student;
use App\Course;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('departments.index', [
            'contentheader' => 'Departments',
            'departments' => Department::all(),
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
        return view('departments.create', [
            'contentheader' => 'Create',
            'breadcrumbs' => [
                [
                    'text' => 'Departments',
                    'link' => route('departments.index'),
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
            'name' => 'required|string|unique:departments,name',
            'shortname' => 'required|string|max:20|unique:departments,shortname',
            'faculty_id' => 'sometimes|exists:faculties,id',
            'hexcolor' => 'required|max:6|min:6|regex:/[0-9a-fA-F]{6}/'
        ]);
        Department::create($request->all());
        return redirect(route('departments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($department = Department::find($id), 404);
        return view('departments.show', [
            'contentheader' => $department->shortname,
            'breadcrumbs' => [
                [
                    'text' => 'Departments',
                    'link' => route('departments.index'),
                ],
                [
                    'text' => $department->shortname
                ]
            ],
            'department' => $department,
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
        abort_unless(is_numeric($id), 404);
        abort_unless($department = Department::find($id), 404);
        return view('departments.edit', [
            'contentheader' => 'Edit',
            'breadcrumbs' => [
                [
                    'text' => 'Departments',
                    'link' => route('departments.index'),
                ],
                [
                    'text' => $department->shortname,
                    'link' => route('departments.show', $department->id),
                ],
                [
                    'text' => 'Edit',
                ]
            ],
            'department' => $department,
        ]);
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
        abort_unless(is_numeric($id), 404);
        abort_unless($department = Department::find($id), 404);
        $request->validate([
            'name' => 'required|string|unique:departments,name,'.$id,
            'shortname' => 'required|string|max:20|unique:departments,name,'.$id,
            'faculty_id' => 'sometimes|exists:faculties,id',
            'hexcolor' => 'required|max:6|min:6|regex:/[0-9a-fA-F]{6}/'
        ]);
        $department->update($request->all());
        return redirect(route('departments.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
