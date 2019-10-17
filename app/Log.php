<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'from', 'type',
    ];

    public $timestamps = true;

    public function log_by()
    {
        return $this->morphTo();
    }
}
