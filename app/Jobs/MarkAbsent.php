<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Course;
use App\Events\MarkAbsent as MarkAbsentEvent;
use App\Student;
use App\Faculty;
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
        $ended = [];
        $logs = [];
        foreach(
            Course::currentcourses()->load(['faculty', 'students', 'logs'])
        as $course) {
            foreach(
                array_diff(
                    iterator_to_array(
                        CarbonPeriod::create(
                            $course->academic_period->start, date('Y-m-d')
                        )->filter(function($day) use($course) {
                            return !$course->noclass($day);
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
                if(!$course->forchecking(Carbon::create($day))) {
                    continue;
                }
                if(
                    $course->faculty &&
                    !$course->logs()->where([
                        'log_by_id' => $course->faculty->id,
                        'log_by_type' => Faculty::class,
                    ])->whereDate('date', $day)->first()
                ) {
                    // $logs[] = [
                    //     'log_by_id' => $course->faculty->id,
                    //     'log_by_type' => get_class($course->faculty),
                    //     'course_id' => $course->id,
                    //     'date' => $day,
                    //     'remarks' => 'absent',
                    //     'process' => 'auto',
                    //     'created_at' => now(),
                    //     'updated_at' => now(),
                    // ];
                    $course->parsefacultylogsbydate(Carbon::create($day));
                }
                foreach($course->students as $student) {
                    if(
                        !$course->logs()->where([
                            'log_by_id' => $student->id,
                            'log_by_type' => Student::class,
                        ])->whereDate('date', $day)->first()
                    ) {
                        $logs[] = [
                            'log_by_id' => $student->id,
                            'log_by_type' => Student::class,
                            'course_id' => $course->id,
                            'date' => $day,
                            'remarks' => 'absent',
                            'process' => 'auto',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                $course->updateinformation(Carbon::create($day));
                $ended[] = [
                    'course_id' => $course->id,
                    'date' => $day,
                ];
            }
        }
        DB::table('ended_classes')->insert($ended);
        DB::table('logs')->insert($logs);
    }
}
