<?php

namespace App\Jobs;

use App\AcademicPeriod;
use App\Course;
use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\FetchHolidays as FetchHolidayEvent;

class FetchHolidays implements ShouldQueue
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
        for($x = date('Y') - 5, $y = []; $x < date('Y') + 5; $x++) {
            $y[] = $x;
        }
        $z = array_unique(Event::all()->filter(function($event) {
            return $event->remarks == 'national holiday';
        })->pluck('from')->map(function($date) {
            return $date ? $date->format('Y') : '';
        })->all());
        foreach(array_diff($y, $z) as $x) {
            foreach(json_decode(trim(file_get_contents("https://calendarific.com/api/v2/holidays?&api_key=440cb0e39eb9a2883607a18c0dea5b7db597e2df&country=PH&year=".$x."&type=national")))->response->holidays as $event) {
                Event::updateOrCreate([
                    'start' => $event->date->iso,
                    'end' => $event->date->iso,
                    'title' => $event->name ?? '',
                ], [
                    'description' => $event->description,
                    'remarks' => 'national holiday',
                ]);
            };
        }
        exec('touch /home/joowdx/hello.txt');
        event(new FetchHolidayEvent());
    }
}
