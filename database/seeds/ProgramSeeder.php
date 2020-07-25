<?php

use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Program::class)->states(['BSIT'])->create();
        factory(App\Program::class)->states(['BSCpE'])->create();
        factory(App\Program::class, 6)->create();
    }
}
