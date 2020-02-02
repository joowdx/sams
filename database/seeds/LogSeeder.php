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
        factory(App\Log::class, 60)->states(['IT111L FCLT'])->create();
        factory(App\Log::class, 60)->states(['IT112L FCLT'])->create();

        factory(App\Log::class, 60)->states(['IT111L JOHN'])->create();
        factory(App\Log::class, 60)->states(['IT111L JANE'])->create();

        factory(App\Log::class, 60)->states(['IT112L JOHN'])->create();
        factory(App\Log::class, 60)->states(['IT112L JANE'])->create();
    }
}
