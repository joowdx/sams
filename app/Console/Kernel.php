<?php

namespace App\Console;

use App\AcademicPeriod;
use App\Course;
use App\Event;
use App\Events\FetchHolidays;
use App\Jobs\FetchHolidays as JobsFetchHolidays;
use App\Jobs\RefreshMap;
use App\Jobs\MarkAbsent;
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
        $schedule->job(new RefreshMap(), 'refreshmap')->when(function() {
            return true;
            return ($minute = Carbon::now()->format('i')) == '00' || $minute == '30';
        })->skip(function() {
            return Carbon::now()->format('i') == 'Sunday';
        })->everyMinute();

        // $schedule->job(new JobsFetchHolidays())->when(function() {
        //     return true;
        //     for($x = date('Y') - 5, $y = []; $x < date('Y') + 5; $x++) { $y[] = $x; }
        //     $z = array_unique(Event::all()->pluck('start')->map(function($date) {return $date->format('Y');})->all());
        //     return array_diff($y, $z);
        // })->everyMinute();

        $schedule->job(new MarkAbsent)->everyMinute();

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
