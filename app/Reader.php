<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    private static $rooms, $gates;

    protected $fillable = [
        'name', 'ip', 'type',
    ];

    public static function rooms($refresh = false)
    {
        if($refresh) {
            Reader::$rooms = Reader::where(['type' => 'room'])->get();
        }
        return Reader::$rooms ?? Reader::rooms(true);
    }

    public static function gates($refresh = false)
    {
        if($refresh) {
            Reader::$gates = Reader::where(['type' => 'gate'])->get();
        }
        return Reader::$gates ?? Reader::$gates(true);
    }

    public static function findbyname($name)
    {
        return Reader::where(['name' => $name])->first();
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'room_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function session()
    {
        return $this->courses->first(function($course) { return $course->onsession(); });
    }

    public function upcomingsession()
    {
        return $this->courses;
    }
}
