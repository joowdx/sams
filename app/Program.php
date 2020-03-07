<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

    protected $with = [
        // 'department'
    ];

    protected $fillable = [
        'name', 'shortname', 'faculty_id', 'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }
}
