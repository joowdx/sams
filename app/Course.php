<?php

namespace App;

use Carbon\Carbon;
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

    public function haslogged(Student $sf, Carbon $dt = null)
    {
        $dt = $dt ?: Carbon::now();
        $dt->setTime(explode(':', $this->time_from)[0], explode(':', $this->time_from)[1]);
        $te = $dt->copy()->setTime(explode(':', $this->time_to)[0], explode(':', $this->time_to)[1]);
        return $this->logsof($dt)->first(function($log) use($sf, $dt, $te){
            return $log->log_by->id == $sf->id && $log->created_at->between($dt, $te);
        });
    }


    public function nolog($sf)
    {
        return !$this->haslogged($sf);
    }

    public function onsession()
    {
        $now = Carbon::now();
        $fr = Carbon::create($now->year, $now->month, $now->day, explode(':', $this->time_from)[0], explode(':', $this->time_from)[1], 0);
        $to = Carbon::create($now->year, $now->month, $now->day, explode(':', $this->time_to)[0], explode(':', $this->time_to)[1], 0);
        return $now->between($fr, $to);
    }

    public function absences($day) {

    }
}
