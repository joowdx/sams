<?php

namespace App\Jobs;

use App\AcademicPeriod;
use App\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\RefreshMap as RefreshMapEvent;

class RefreshMap implements ShouldQueue
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
        event(
            new RefreshMapEvent(
                // Course::whereIn('academic_period_id',
                //     AcademicPeriod::where(function($query) {
                //         $query->whereDate('start', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
                //     })->get()->map(function($period) {
                //         return $period->id;
                //     })->all()
                // )->with('room')->get()->toJson()
                Course::with(['logs' => function($query) {
                    $query->whereDate('date', today())->where(['log_by_type' => 'App\Faculty']);
                }, 'logs.log_by', 'faculty'])->whereIn('academic_period_id',
                    AcademicPeriod::where(function($query) {
                        $query->whereDate('start', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
                    })->get()->map(function($period) {
                        return $period->id;
                    })->all()
                )->whereTime('time_from', '<=', date('H:i'))->whereTime('time_to', '>', date('H:i'))->with('room')->get()
            )
        );
    }
}
