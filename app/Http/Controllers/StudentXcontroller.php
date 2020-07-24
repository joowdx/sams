<?php

namespace App\Http\Controllers;

use App\Student;
use App\AcademicPeriod as Period;
use Illuminate\Http\Request;

class StudentXcontroller extends Controller
{
    public function __invoke($id)
    {
        if(!is_numeric($id)) {
            return redirect('studentauth')->with('error', 'Non Numeric ID');
        }
        if(!($student = Student::where(['schoolid' => $id])->first())) {
            return redirect('studentauth')->with('error', 'Non Existent ID');
        }
        return view('xstudent', [
            'student' => $student->load(['courses', 'courses.faculty']),
            'currentschoolyear' => Period::currentschoolyear(),
            'currentsemester' => Period::currentsemester(),
            'semesters' => Period::groupBy('semester')->get('semester')->pluck('semester'),
            'schoolyears' => Period::groupBy('school_year')->orderBy('school_year', 'desc')->get('school_year')->pluck('school_year'),
        ]);
    }
}
