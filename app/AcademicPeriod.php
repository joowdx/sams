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

    public function iscurrentperiod()
    {
        return now()->between($this->start, $this->end);
    }
}
