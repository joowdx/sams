<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalConfiguration extends Model
{
    protected $fillable = [
        'name', 'value', 'updated_by'
    ];

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public static function grace()
    {
        return GlobalConfiguration::where('name', 'graceperiod')->first()->value;
    }
}
