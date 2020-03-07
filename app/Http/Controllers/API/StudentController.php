<?php

namespace App\Http\Controllers\API;

use App\Student;
use App\AcademicPeriod as Period;
use App\Http\Resources\StudentResource;
use App\Http\Controllers\Controller;
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
        return StudentResource::collection(Student::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'schoolyear' => 'string',
            'semester' => 'string'
        ]);
        abort_unless(is_numeric($id), 404);
        abort_unless($validator->passes(), 400);
        $schoolyear = $request->schoolyear ??  Period::currentschoolyear();
        $semester =  $request->semester ?? Period::currentsemester();
        $period = Period::where('school_year', $schoolyear)->where('semester', env('DB_CONNECTION') == 'pgsql' ? 'ilike' : 'like', "%$semester%")->get()->pluck('id');
        $student = Student::findOrFail($id)->load([
            'courses' =>  function($query) use($period) {
                $query->whereIn('academic_period_id', $period);
            },
            'courses.logs' => function($query) use($id) {
                $query->where('log_by_type', 'App\Student')->where('log_by_id', $id);
            },
            'courses.logs.course',
        ]);

        return new \App\Http\Resources\StudentAtt($student);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
