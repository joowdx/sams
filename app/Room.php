<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'from_by');
    }

    public function session()
    {
        return $this->courses->first(function($course) { return $course->onsession(); });
    }
}
