<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $fillable = [
        'name', 'ip', 'type',
    ];

    public static function rooms()
    {
        return Reader::where(['type' => 'room'])->get();
    }

    public static function gates()
    {
        return Reader::where(['type' => 'gate'])->get();
    }

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
