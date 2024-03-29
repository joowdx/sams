<?php

use Illuminate\Database\Seeder;

class AcademicPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AcademicPeriod::class)->states('SEMESTER')->create();
        factory(App\AcademicPeriod::class)->states('1TERM')->create();
        factory(App\AcademicPeriod::class)->states('2TERM')->create();
    }
}
