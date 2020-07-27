<?php

namespace App\Console;

use App\Jobs\FetchHolidays as JobsFetchHolidays;
use App\Jobs\RefreshMap;
use App\Jobs\MarkAbsent;
use App\Jobs\ClearUnknownTags;
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
        $schedule->job(new RefreshMap)->withoutOverlapping()->everyMinute()->runInBackGround();
        $schedule->job(new MarkAbsent)->withoutOverlapping()->runInBackGround();
        // $schedule->job(new MarkAbsent)->withoutOverlapping()->everyThirtyMinutes()->runInBackGround();
        // $schedule->job(new ClearUnknownTags)->withoutOverlapping()->everyMinute()->runInBackGround();
        $schedule->job(new JobsFetchHolidays)->weeklyOn(1, '6:00')->withoutOverlapping()->runInBackground();
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
