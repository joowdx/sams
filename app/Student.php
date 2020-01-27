<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'uid', 'name',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'log_by');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function showStudentDetails($id){
        
        $result = DB::select('SELECT * FROM students s
        LEFT JOIN course_student cs ON(cs.student_id = s.id)
        LEFT JOIN courses c ON(c.id = cs.course_id) where s.uid = ?',[(string)$id]);
        return $result;
    }

    public function entered()
    {
        return @$this->logs()->where('from_by_type', 'App\Gate')->latest()->first()->remarks == 'entry';
    }

    public function exited()
    {
        return @$this->logs()->where('from_by_type', 'App\Gate')->latest()->first()->remarks != 'entry';
    }

}
