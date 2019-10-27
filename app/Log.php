<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'type', 'remarks'
    ];

    public $timestamps = true;

    public function from_by()
    {
        return $this->morphTo();
    }

    public function log_by()
    {
        return $this->morphTo();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
