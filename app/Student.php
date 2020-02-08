<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'uid', 'schoolid', 'name', 'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)->withPivot('status')->withTimestamps();
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'log_by');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function entered()
    {
        return @$this->logs()->where('from_by_type', 'App\Gate')->latest()->first()->remarks == 'entry';
    }

    public function exited()
    {
        return @$this->logs()->where('from_by_type', 'App\Gate')->latest()->first()->remarks != 'entry';
    }

    public function logsto($course)
    {
        return $this->logs()->where('course_id', $course)->get();
    }

    public function enrolled($schoolyear = null, $semester = null)
    {
        return $this->enrolledcourses($schoolyear, $semester)->first() ? true : false;
    }

    public function enrolledcourses($schoolyear = null, $semester = null)
    {
        $schoolyear = $schoolyear ?? AcademicPeriod::currentschoolyear();
        $semester = $semester ?? AcademicPeriod::currentsemester();
        return $this->courses()->whereIn('academic_period_id', AcademicPeriod::where('school_year', $schoolyear)->where('semester', $semester)->get()->pluck('id'))->get();
    }

}
