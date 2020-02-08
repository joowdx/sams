<?php

namespace App;

use Carbon\Carbon;
use App\Event;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code', 'title', 'description', 'day_from', 'day_to', 'time_from', 'time_to', 'units', 'faculty_id', 'room_id',
    ];

    public static function currentcourses($schoolyear = null, $semester = null)
    {
        $schoolyear = $schoolyear ?? AcademicPeriod::currentschoolyear();
        $semester = $semester ?? AcademicPeriod::currentsemester();
        return Course::whereIn('academic_period_id', AcademicPeriod::where('school_year', $schoolyear)->where('semester', $semester)->get()->pluck('id'))->with('faculty')->get();
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function academic_period()
    {
        return $this->belongsTo(AcademicPeriod::class);
    }

    public function logsof(Carbon $dt = null)
    {
        $dt = $dt ?: today();
        $dt->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]);
        $te = $dt->copy()->setTime(explode(':', $this->time_to)[0], explode(':', $this->time_to)[1]);
        return $this->logs->filter(function($log) use($dt, $te) { return $log->created_at->between($dt, $te); });
    }

    public function haslogged($sf, Carbon $dt = null)
    {
        return $this->logs()->where('log_by_id', $sf->id)->where('log_by_type', get_class($sf))->whereDate('date', $dt ?? today())->first();
    }


    public function nolog($sf, Carbon $dt = null)
    {
        return !$this->logs()->where('log_by_id', $sf->id)->where('log_by_type', get_class($sf))->whereDate('date', $dt ?? today())->first();
    }

    public function onsession()
    {
        return $this->academic_period->iscurrentperiod() && now()->between(today()->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]), today()->setTime(explode(':', $this->time_to)[0], explode(':', $this->time_to)[1]));
    }

    public function ongoing()
    {
        return $this->academic_period->iscurrentperiod();
    }

    public function absences(Carbon $day = null)
    {
        $day = $day ?? today();
        return $this->logs()->where('remarks', 'absent')->whereDate('date', $day)->get();
    }

    public function noclass(Carbon $day = null)
    {
        $day = $day ?? today();
        $week = ['Mon' => 0, 'Tue' => 1, 'Wed' => 2, 'Thu' => 3, 'Fri' => 4, 'Sat' => 5, 'Sun' => 6,];
        return Event::noclass($day) || !($week[$this->day_from] <= ($d  = $week[$day->format('D')]) && $week[$this->day_to] >= $d) || $this->academic_period->ended() || !$this->academic_period->started();
    }

    public function nextmeeting(Carbon $day = null)
    {
        $day = $day ?? today();
        do {
            if($this->academic_period->end->lte($day)) {
                $day = null;
                break;
            }
            $day->addDay();
        } while($this->noclass($day));
        return $day ? $day->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]) : null;
    }

    public function firstmeeting()
    {
        return $this->noclass($this->academic_period->start) ? $this->nextmeeting($this->academic_period->start) : $this->academic_period->start->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]);
    }

    public function allowed($sf)
    {
        return $sf->entered();
    }
}
