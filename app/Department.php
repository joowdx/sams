<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $fillable = [
        'name', 'shortname', 'faculty_id'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function courses()
    {
        return $this->hasManyDeep(Course::class, [Faculty::class])->
        where(function($query) {
            $query->where('faculty_id', $this->id)->whereIn('academic_period_id', AcademicPeriod::whereDate('start', '<=', today())->whereDate('end', '>=', today())->get()->pluck('id'));
        });
    }

    public function enrolledstudents()
    {
        $this->students->filter(function($student) { return $student->enrolled(); });
    }
}
