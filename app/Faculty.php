<?php

namespace App;

use App\Log;
use App\User;
use App\Course;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'uid', 'name',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'log_by');
    }

    public function created_by() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
