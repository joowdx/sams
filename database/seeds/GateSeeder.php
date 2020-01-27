<?php

use Illuminate\Database\Seeder;

class GateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'Generating G1 G2 gates...';
        factory(App\Gate::class)->states(['G1', 'G2'])->create();
    }
}
