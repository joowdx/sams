<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'remarks', 'date', 'process',
    ];

    protected $dates = [
        'date',
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

    public function updatedby()
    {
        return $this->belongsTo(User::class);
    }
}
