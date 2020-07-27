<?php

namespace App\Jobs;

use App\AcademicPeriod;
use App\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\API\ClassesQueryController;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\RefreshMap as RefreshMapEvent;
use App\Student;

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
        event(new RefreshMapEvent(Course::getclasses(), Student::inpremises(), Student::checkedin()));
    }
}
