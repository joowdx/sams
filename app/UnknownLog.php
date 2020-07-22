<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnknownLog extends Model
{
    protected $fillable = [
        'uid', 'from', 'ip', 'status', 'method', 'remarks', 'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
