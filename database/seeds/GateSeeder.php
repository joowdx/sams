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
        factory(App\Gate::class)->states(['G1'])->create();
        factory(App\Gate::class)->states(['G2'])->create();
    }
}
