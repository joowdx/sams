<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'school_id', 'name',
    ];

    public function logs()
    {
        return $this->morphMany(Log::class, 'log_by');
    }
}
