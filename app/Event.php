<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'start', 'end', 'remarks'
    ];

    protected $dates = [
        'start', 'end',
    ];

    public static function noclass(Carbon $day = null) {
        $day = $day ?? Carbon::now();
        return (boolean) Event::where('remarks', '<>', 'info')->whereDate('start', '<=', $day)->whereDate('end', '>=', $day)->get()->first();
    }

    public static function nextworkingday(Carbon $day = null) {
        $day = $day ?? Carbon::now();
        do {
            $day->addDay();
        } while (Event::noclass($day));
        return $day;
    }


    public static function upcoming($count = 5) {
        return Event::whereDate('start', '>=', today())->orderBy('start', 'asc')->take($count)->get();
    }

    public static function ongoing() {
        return Event::whereDate('start', '<=', today())->whereDate('end', '>=', today())->get();
    }

}
