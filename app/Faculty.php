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
        return $this->program->belongsTo(Department::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'log_by');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function modify()
    {
        return $this->belongsTo(User::class, 'id', 'modified_by');
    }

    public function isdepartmenthead()
    {
        return $this->department->faculty->id == $this->id;
    }

    public function isprogramhead()
    {
        return $this->program->faculty->id == $this->id;
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

    public function loads()
    {
        $schoolyear = $schoolyear ?? AcademicPeriod::currentschoolyear();
        $semester = $semester ?? AcademicPeriod::currentsemester();
        $period = AcademicPeriod::period($schoolyear, $semester);
        return $this->courses->filter(function($course) use($period) {
            return $period->contains($course->academic_period_id);
        });
    }
}
