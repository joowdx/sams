<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Course;
use App\AcademicPeriod;
use App\Events\MarkAbsent as MarkAbsentEvent;
use App\Student;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonPeriod;
use Carbon\Carbon;


class MarkAbsent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach(
            Course::whereIn('academic_period_id',
                AcademicPeriod::where(function($query) {
                    $query->whereDate('start', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
                })->get()->map(function($period) {
                    return $period->id;
                })->all()
            )->with(['students', 'logs'])->get()
        as $course) {
            foreach(
                array_diff(
                    iterator_to_array(
                        CarbonPeriod::create(
                            $course->academic_period->start, date('Y-m-d')
                        )->filter(function($day) use($course) {
                            return $course->noclass($day);
                        })->map(function($day) {
                            return $day->format('Y-m-d');
                        })
                    ),
                    DB::table('ended_classes')->where([
                        'course_id' => $course->id,
                    ])->get()->map(function($day) {
                        return $day->date;
                    })->all()
                )
            as $day) {
                foreach($course->students as $student) {
                    if(
                        !$course->logs()->where([
                            'log_by_id' => $student->id,
                            'log_by_type' => get_class($student),
                        ])->whereDate('date', $day)->first()
                    ) {
                        $course->logs()->save($student->logs()->create(['remarks' => 'absent', 'date' => $day]));
                    }
                }
                DB::table('ended_classes')->insert([
                    'course_id' => $course->id,
                    'date' => Carbon::createFromFormat('Y-m-d', $day),
                ]);
            }

        }
    }
}
