<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnknownLog extends Model
{
    protected $fillable = [
        'uid', 'from', 'ip', 'status', 'remarks', 'data'
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
