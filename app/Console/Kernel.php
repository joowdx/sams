<?php

namespace App\Console;

use App\AcademicPeriod;
use App\Course;
use App\Event;
use App\Events\FetchHolidays;
use App\Jobs\FetchHolidays as JobsFetchHolidays;
use App\Jobs\RefreshMap;
use App\Jobs\MarkAbsent;
use App\Jobs\ClearUnknownTags;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new ClearUnknownTags)->withoutOverlapping()->everyMinute();
        $schedule->job(new MarkAbsent)->withoutOverlapping()->everyThirtyMinutes()->runInBackGround();
        $schedule->job(new RefreshMap)->withoutOverlapping()->everyThirtyMinutes();
        $schedule->job(new JobsFetchHolidays)->yearly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
