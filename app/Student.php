<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'school_id', 'name',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'log_by');
    }
}
