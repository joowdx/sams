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
        factory(App\Program::class)->states('BSIT')->create();
        factory(App\Program::class)->states('BSCpE')->create();
        factory(App\Program::class)->states('BSPsych')->create();
        factory(App\Program::class)->states('BSPolSci')->create();
        factory(App\Program::class)->states('BSMM')->create();
        factory(App\Program::class)->states('BSFM')->create();
        factory(App\Program::class)->states('BSA')->create();
        factory(App\Program::class)->states('BSCrim')->create();
        factory(App\Program::class)->states('BSED')->create();
        factory(App\Program::class)->states('BEED')->create();
        factory(App\Program::class)->states('BTTE')->create();
    }
}
