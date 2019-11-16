<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code', 'title', 'description', 'semester', 'term', 'day_from', 'day_to', 'time_from', 'time_to', 'units', 'faculty_id', 'room_id',
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

}
