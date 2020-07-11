<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicPeriod extends Model
{
    protected $fillable = [
        'school_year', 'semester', 'term', 'start', 'end',
    ];

    protected $dates = [
        'start', 'end',
    ];

    private static $currentschoolyear, $currentsemester, $current;

    private static $periods = [];

    private static function setcurrent($get = null)
    {
        $current = AcademicPeriod::whereDate('start', '<=', today())->whereDate('end', '>=', today())->first();
        if(!$current) {
            return;
        }
        AcademicPeriod::$currentschoolyear = $current->school_year;
        AcademicPeriod::$currentsemester = $current->semester;
        AcademicPeriod::$current = AcademicPeriod::where('school_year', AcademicPeriod::$currentschoolyear)->where('semester', AcademicPeriod::$currentsemester)->get();
        AcademicPeriod::$periods[AcademicPeriod::$currentschoolyear.AcademicPeriod::$currentsemester] = AcademicPeriod::$current;
        switch($get) {
            case 'sy': return AcademicPeriod::$currentschoolyear;
            case 'sm': return AcademicPeriod::$currentsemester;
            case 'cr': return AcademicPeriod::$current;
        }
    }

    public static function currentschoolyear()
    {
        return AcademicPeriod::$currentschoolyear ?? AcademicPeriod::setcurrent('sy');
    }

    public static function currentsemester()
    {
        return AcademicPeriod::$currentsemester ?? AcademicPeriod::setcurrent('sm');
    }

    public static function current()
    {
        return AcademicPeriod::$current ?? AcademicPeriod::setcurrent('cr');
    }

    public static function period($schoolyear = null, $semester = null)
    {
        return AcademicPeriod::$periods[($schoolyear ?? AcademicPeriod::currentschoolyear()) . ($semester ?? AcademicPeriod::currentsemester())] ?? AcademicPeriod::$periods[($schoolyear ?? AcademicPeriod::currentschoolyear()) . ($semester ?? AcademicPeriod::currentsemester())] = AcademicPeriod::where('school_year', $schoolyear ?? AcademicPeriod::currentschoolyear())->where('semester', AcademicPeriod::currentsemester())->get();
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function enrolledstudents()
    {
        return $this->hasManyThrough(Student::class, Course::class);
    }

    public function started()
    {
        return $this->start->lt(now());
    }

    public function ended()
    {
        return $this->end->lt(now());
    }

    public function iscurrentschoolyear()
    {
        return AcademicPeriod::currentschoolyear() == $this->school_year;
    }

    public function iscurrentsemester()
    {
        return AcademicPeriod::currentsemester() == $this->semester;
    }

    public function iscurrentperiod()
    {
        return today()->between($this->start, $this->end);
    }

    public function name()
    {
        if($this->term != 'SEMESTER' && $this->semester != 'SUMMER') {
            return "$this->semester Sem - $this->term Term ($this->school_year)";
        }
        else {
            return $this->semester . ($this->semester  == 'SUMMER' ? '' : 'Sem') . " ($this->school_year)";
        }
    }
}
