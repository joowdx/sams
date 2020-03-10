<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseStudentStatus extends Pivot
{
    public function student()
    {
        $this->belongsTo(Student::class);
    }

    public function course()
    {
        $this->belongsTo(Course::class);
    }
}
