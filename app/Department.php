<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $fillable = [
        'name', 'shortname', 'faculty_id', 'hexcolor'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function faculties()
    {
        return $this->hasManyDeep(Faculty::class, [Program::class]);
    }

    public function students()
    {
        return $this->hasManyDeep(Student::class, [Program::class]);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    // public function courses()
    // {
    //     return $this->hasManyDeep(Course::class, [Faculty::class])->
    //     where(function($query) {
    //         $query->where('faculty_id', $this->id)->whereIn('academic_period_id', AcademicPeriod::whereDate('start', '<=', today())->whereDate('end', '>=', today())->get()->pluck('id'));
    //     });
    // }

    public function enrolledstudents()
    {
        $this->students->filter(function($student) { return $student->enrolled(); });
    }
}
