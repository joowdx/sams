<?php

use Illuminate\Database\Seeder;

class ReaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Reader::class)->states(['G1'])->create();
        factory(App\Reader::class)->states(['G2'])->create();
        factory(App\Reader::class)->states(['CL1'])->create();
        factory(App\Reader::class)->states(['CL2'])->create();
        factory(App\Reader::class)->states(['CL3'])->create();
    }
}
