<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{
    protected $fillable = [
        'name',
    ];

    public function logs()
    {
        return $this->morphMany(Log::class, 'from_by');
    }
}
