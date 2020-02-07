<?php

use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $it111l = today()->diffInDays(App\Course::find(1)->firstmeeting());
        $it112l = today()->diffInDays(App\Course::find(2)->firstmeeting());

        $it111l -= (2 * ($it111l / 7 - 1));
        $it112l -= (2 * ($it112l / 7 - 1));

        factory(App\Log::class, $it111l)->states(['IT111L FCLT'])->create();
        factory(App\Log::class, $it112l)->states(['IT112L FCLT'])->create();

        factory(App\Log::class, $it111l)->states(['IT111L JOHN'])->create();
        factory(App\Log::class, $it112l)->states(['IT111L JANE'])->create();

        factory(App\Log::class, $it111l)->states(['IT112L JOHN'])->create();
        factory(App\Log::class, $it112l)->states(['IT112L JANE'])->create();
    }
}
