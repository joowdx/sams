<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnverifiedTag extends Model
{
    protected $fillable = [
        'uid', 'from', 'ip', 'status',
    ];
}
