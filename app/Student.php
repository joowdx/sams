<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $with = [
        // 'program',
    ];

    protected $fillable = [
        'uid', 'schoolid', 'name', 'department_id'
    ];

    public static function findbyuid($uid)
    {
        return Student::where(['uid' => $uid])->first();
    }

    public function department()
    {
        return $this->program->belongsTo(Department::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
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
        return @$this->logs()
            ->whereDate('date', today())
            ->whereIn('remarks', ['entry', 'exit'])
            ->whereNotIn('reader_id', Reader::rooms())
            ->latest()->first()->remarks == 'entry';
    }

    public function exited()
    {
        return @$this->logs()
            ->whereDate('date', today())
            ->whereIn('remarks', ['entry', 'exit'])
            ->whereNotIn('reader_id', Reader::rooms())
            ->latest()->first()->remarks != 'entry';
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
        $period = AcademicPeriod::period($schoolyear, $semester);
        return $this->courses->filter(function($course) use($period) {
            return $period->contains($course->academic_period_id);
        });
    }

}
