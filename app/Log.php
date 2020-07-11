<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'remarks', 'date', 'process', 'info', 'created_at'
    ];

    protected $dates = [
        'date',
    ];

    protected $casts = [
        'info' => 'array',
    ];

    public $timestamps = true;

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

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }
}
