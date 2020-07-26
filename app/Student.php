<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'uid', 'schoolid', 'name', 'program_id', 'avatar'
    ];

    protected $appends = [
        'enrolled'
    ];

    public static function inpremises()
    {
        return Student::with(['logs' => function($q) {
            $q->whereDate('date', today());
            $q->whereIn('remarks', ['entry', 'exit']);
            $q->latest();
            $q->first();
        }])->whereHas('logs', function($q) {
            $q->whereDate('date', today());
            $q->whereIn('remarks', ['entry', 'exit']);
        })->get()->filter(function($faculty) {
            return $faculty->logs->first()->remarks == 'entry';
        });
    }

    public static function checkedin()
    {
        return Student::with(['logs' => function($q) {
            $q->whereDate('date', today());
            $q->whereIn('remarks', ['entry', 'exit']);
            $q->first();
        }])->whereHas('logs', function($q) {
            $q->whereDate('date', today());
            $q->whereIn('remarks', ['entry', 'exit']);
        })->get();
    }

    public static function findbyuid($uid)
    {
        return Student::where(['uid' => $uid])->first();
    }

    public function getEnrolledAttribute()
    {
        return $this->enrolled();
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
            ->whereNotIn('reader_id', Reader::rooms()->pluck('id'))
            ->latest()->first()->remarks == 'entry';
    }

    public function exited()
    {
        return @$this->logs()
            ->whereDate('date', today())
            ->whereIn('remarks', ['entry', 'exit'])
            ->whereNotIn('reader_id', Reader::rooms()->pluck('id'))
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
