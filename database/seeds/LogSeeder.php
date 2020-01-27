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
        echo 'Generating random logs for John Doe...';
        factory(App\Log::class, 60)->states(['IT111L JOHN'])->create();
        factory(App\Log::class, 60)->states(['IT112L JANE'])->create();
        echo 'Generating random logs for Jane Doe...';
        factory(App\Log::class, 60)->states(['IT112L JOHN'])->create();
        factory(App\Log::class, 60)->states(['IT111L JANE'])->create();
    }
}
