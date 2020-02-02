<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Faculty extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $fillable = [
        'uid', 'name',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'log_by');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function students()
    {
        return $this->hasManyDeep(Student::class, [
            Course::class, 'course_student'
        ])->with(['courses' => function($query) {
            $query->where('faculty_id', $this->id)->whereIn('academic_period_id', AcademicPeriod::whereDate('start', '<=', today())->whereDate('end', '>=', today())->get()->pluck('id'));
        }])->get()->unique();
    }

    public function logsto($course)
    {
        return $this->logs()->where('course_id', $course)->get();
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function ongoingcourses()
    {
        return $this->courses()->whereIn('academic_period_id', AcademicPeriod::whereDate('start', '<=', today())->whereDate('end', '>=', today())->get()->pluck('id'))->get();
    }
}
