<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Resources\CourseResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CourseResource::collection(
            Course::with([
                'faculty',
                'students',
                'students.department'
            ])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
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
        abort_unless(
            $course = Course::find($id)->load([
                'faculty',
                'students',
                'students.department',
                'logs',
                'logs.log_by',
                'students.logs' => function($query) use($id) {
                    $query->where('course_id', $id);
                },
                'faculty.logs' => function($query) use($id) {
                    $query->where('course_id', $id);
                },
            ]), 404
        );
        return new CourseResource($course);
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
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
