<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    private $parsedfacultylogs;

    protected $with = [
        'room', 'academic_period', 'logs', 'faculty'
    ];

    protected $fillable = [
        'code', 'title', 'description', 'day_from', 'day_to', 'time_from', 'time_to', 'units', 'faculty_id', 'room_id', 'academic_period_id'
    ];

    public static function currentcourses($schoolyear = null, $semester = null)
    {
        $schoolyear = $schoolyear ?? AcademicPeriod::currentschoolyear();
        $semester = $semester ?? AcademicPeriod::currentsemester();
        return Course::whereIn('academic_period_id', AcademicPeriod::where('school_year', $schoolyear)->where('semester', $semester)->get()->pluck('id'))->with('faculty')->get();
    }

    public static function findforattendance($room)
    {
        return Course::currentcourses()
            ->filter(function($course) use($room) {
                return $course->room->name == $room;
            })
            ->first(function($course) {
                return $course->forattendance();
            });
    }

    public static function getclasses()
    {
        return Course::with(['logs' => function($query) {
            $query->whereDate('date', today());
        }, 'students', 'logs.log_by', 'faculty', 'faculty.program', 'faculty.program.department'])->whereIn('academic_period_id',
            AcademicPeriod::where(function($query) {
                $query->whereDate('start', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
            })->get()->map(function($period) {
                return $period->id;
            })->all()
        )->whereTime('time_from', '<=', now()->addMinutes(5)->format('H:i'))->whereTime('time_to', '>', now()->addMinutes(5)->format('H:i'))->with('room')->get();
    }

    public static function findonsession($room = null)
    {
        $course = Course::currentcourses()
            ->filter(function($course) {
                return !$course->noclass() && $course->onsession();
            });
        return $room ? $course->first(function($course) use($room) {
            return $course->room->name == $room;
        }) : $course;
    }

    public function room()
    {
        return $this->belongsTo(Reader::class, 'room_id', 'id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot('status');
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
        return $this->logs()->whereDate('created_at', $dt)->get();
    }

    public function logsbyasof($sf, $dt = null)
    {
        $dt = $dt ?: today();
        return $this->logs()
            ->whereDate('created_at', $dt)
            ->where(['log_by_type' => get_class($sf), 'log_by_id' => $sf->id])
            ->get();
    }

    public function forattendance()
    {
        return !$this->noclass() && now()->between(Carbon::createFromTimeString($this->time_from)->subMinutes(5), Carbon::createFromTimeString($this->time_to)->subMinutes(5));
    }

    public function facultyloggedontime(Carbon $dt = null)
    {
        return $this->logs()
            ->whereDate('created_at', $dt ?? today())
            ->whereTime('created_at', '>=', Carbon::createFromTimeString($this->time_from)->subMinutes(5))
            ->whereTime('created_at', '<=', Carbon::createFromTimeString($this->time_from)->addMinutes(15))
            ->latest()->first();
    }

    public function facultylateststamp(Carbon $dt = null)
    {
        return @$this->logs()->whereDate('created_at', $dt ?? today())->where('remarks', 'stamp')->latest()->first()->created_at;
    }

    public function haslogged($sf, Carbon $dt = null)
    {
        return $this->logs()->where('log_by_id', $sf->id)->where('log_by_type', get_class($sf))->whereDate('date', $dt ?? today())->first();
    }


    public function nolog($sf, Carbon $dt = null)
    {
        return !$this->logs()
            ->where('log_by_id', $sf->id)
            ->where('log_by_type', get_class($sf))
            ->whereDate('date', $dt ?? today())
            ->where('remarks', '<>', 'denied')
            ->first();
    }

    public function onsession()
    {
        return $this->academic_period->iscurrentperiod() && now()->between(Carbon::createFromTimeString($this->time_from)->subMinutes(5), Carbon::createFromTimeString($this->time_to)->subMinutes(5));
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
        return Event::noclass($day) || !($week[$this->day_from] <= ($d  = $week[$day->format('D')]) && $week[$this->day_to] >= $d) || !$day->between($this->academic_period->start, $this->academic_period->end);
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

    public function forchecking(Carbon $day = null)
    {
        $day = $day ?? today();
        return $day->setTime(explode(':', $this->time_to)[0], explode(':', $this->time_to)[1])->lt(now());
    }

    public function facultyattendance()
    {
        return $this->logs()->where(['log_by_type' => Faculty::class, 'remarks' => 'summary'])->get();
    }

    public function parsefacultylogs()
    {
        foreach(CarbonPeriod::create($this->academic_period->start, $this->academic_period->end) as $date) {
            $this->parsedfacultylogs[$date->format('Y-m-d')] = $this->parsefacultylogsbydate($date);
        }
    }

    public function parsefacultylogsbydate(Carbon $dt = null)
    {
        $dt = $dt ?? today();
        if($this->noclass($dt)) {
            return;
        }
        $this->logs()->whereDate('date', $dt)->where(['log_by_type' => Faculty::class])->where('remarks', '<>', 'stamp')->delete();
        $logs = $this->logs
        ->filter(function($log) use($dt) {
            return $log->date->eq($dt) && $log->remarks == 'stamp';
        })
        ->map(function($log) {
            return $log->created_at;
        })
        ->unique()
        ->sort(function($e, $f){
            return $e->gt($f);
        });
        // dd(today()->gte(now()), $logs->first()->gt(Carbon::createFromTimeString($this->time_from)), $logs->first()->format('H:i'), $this->time_from);
        $info = $this->logs()->create([
            'date' => $dt,
            'remarks' => $logs->all() ? ($logs->first()->gte($dt->copy()->setTimeFrom($this->time_from)) ? 'late' : 'ok') : 'absent' ,
            'process' => 'auto',
            'info' => $logs->all() ? [
                'first' => $logs->first()->format('H:i'),
                'last' => $logs->last()->format('H:i'),
                'minutes' => $logs->count(),
                'time' => $this->gettimeblocks($logs),
                'additionalremarks' => $logs->last()->lt($dt->copy()->setTimeFrom($this->time_to)->subMinutes(15)) ? 'early-out' : null,
            ] : null,
            'created_at' => $logs->first() ?? now()
        ]);
        return $this->faculty->logs()->save($this->room->logs()->save($info));
        $l = $this->logs()->where('remarks', 'stamp')->where('log_by_type', Faculty::class)->get();
        return $l;
    }

    public function updateinformation(Carbon $day = null, $force = false)
    {
        $day = $day ?? today();
        $exists = \DB::table('ended_classes')->where(['course_id' => $this->id])->whereDate('date', $day)->first();
        if($exists == false || $force) {

        }
    }

    private function gettimeblocks($logs)
    {
        $blocks = [];
        $all = array_values($logs->all());
        $start = $logs->first();
        if($logs->count() == 1) {
            $blocks[] = $start->format('H:i');
        }
        $end = null;
        for($x = 1; $x < $logs->count(); $x++) {
            if(@$all[$x]->clone()->addMinute()->eq(@$all[@$x+1])) {
                $end = @$all[@$x+1] ?? $start;
            } else {
                if($start == $logs->first()) {
                    $blocks[] = $start->format('H:i') . ' – ' . @$all[@$x]->format('H:i');
                } else if($start->eq($end) || $end == null) {
                    $blocks[] = $start->format('H:i');
                } else {
                    $blocks[] = $start->format('H:i') . ' – ' . $end->format('H:i');
                }
                $start = @$all[$x + 1];
                $end = null;
            }
        }
        return $blocks;
    }

    public function getdroprate()
    {
        return $this->units == 6 ? 9 : 3;
    }
}
