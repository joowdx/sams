<?php

use App\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dispatch(new App\Jobs\FetchHolidays);
        Event::updateOrCreate([
            'start' => '2019-12-23',
            'end' => '2020-01-05',
            'title' => 'Christmas Break',
            'description' => 'Christmas Break',
            'remarks' => 'break'
        ]);
        for($x = date('Y') - 5, $y = []; $x < date('Y') + 5; $x++) {
            $y[] = $x;
        }
        $z = array_unique(Event::all()->pluck('from')->map(function($date) {
            return $date ? $date->format('Y') : null;
        })->all());
        foreach(array_diff($y, $z) as $x) {
            foreach(json_decode((shell_exec('curl "https://calendarific.com/api/v2/holidays?&api_key=440cb0e39eb9a2883607a18c0dea5b7db597e2df&country=PH&year='.$x.'&type=national"')))->response->holidays as $event) {
                Event::updateOrCreate([
                    'start' => $event->date->iso,
                    'end' => $event->date->iso,
                ], [
                    'title' => $event->name ?? '',
                    'description' => $event->description,
                    'remarks' => 'national holiday',
                ]);
            };
        }
    }
}
