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
        $dt = $dt ?: Carbon::now();
        $dt->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]);
        $te = $dt->copy()->setTime(explode(':', $this->time_to)[0], explode(':', $this->time_to)[1]);
        return $this->logs->filter(function($log) use($dt, $te) { return $log->created_at->between($dt, $te); });
    }

    public function haslogged($sf, Carbon $dt = null)
    {
        $dt = $dt ?? today();
        // $dt->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]);
        // $te = $dt->copy()->setTime(explode(':', $this->time_to)[0], explode(':', $this->time_to)[1]);
        // return $this->logsof($dt)->first(function($log) use($sf, $dt, $te){
        //     return $log->log_by->id == $sf->id && $log->created_at->between($dt, $te);
        // });
        return $this->logs()->where('log_by_id', $sf->id)->where('log_by_type', get_class($sf))->whereDate('date', $dt)->first();
    }


    public function nolog($sf, Carbon $dt = null)
    {
        $dt = $dt ?? today();
        return !$this->logs()->where('log_by_id', $sf->id)->where('log_by_type', get_class($sf))->whereDate('date', $dt)->first();
    }

    public function onsession()
    {
        return $this->academic_period->iscurrentperiod() && now()->between(today()->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]), today()->setTime(explode(':', $this->time_to)[0], explode(':', $this->time_to)[1]));
    }

    public function absences($day) {

    }

    public function noclass(Carbon $day = null) {
        $day = $day ?? Carbon::now();
        $week = ['Mon' => 0, 'Tue' => 1, 'Wed' => 2, 'Thu' => 3, 'Fri' => 4, 'Sat' => 5, 'Sun' => 6,];
        return Event::noclass($day) || !($week[$this->day_from] <= ($d  = $week[$day->format('D')]) && $week[$this->day_to] >= $d) || $this->academic_period->ended();
        // return Event::noclass($day) || !($f <= $d && $t >= $d ) || $this->academic_period->ended();
    }

    public function nextmeeting(Carbon $day = null) {
        $day = $day ?? Carbon::now();
        do {
            if($this->academic_period->ended()) {
                $day = null;
                break;
            }
            $day->addDay();
        } while($this->noclass($day) && $this->academic_period->iscurrentperiod());
        return $day ? $day->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]) : null;
    }

    public function firstmeeting() {
        return $this->noclass($this->academic_period->start) ? $this->nextmeeting($this->academic_period->start) : $this->academic_period->start->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]);
    }

    public function allowed($sf) {
        return $sf->entered();
    }
}
