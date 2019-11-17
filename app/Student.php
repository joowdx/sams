<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'uid', 'name',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'log_by');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function academic_period()
    {
        return $this->hasOneThrough(Course::class, AcademicPeriod::class);
    }
}
