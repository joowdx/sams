<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Department::class)->states('DTP')->create();
        factory(App\Department::class)->states('DTE')->create();
        factory(App\Department::class)->states('DCJE')->create();
        factory(App\Department::class)->states('DAE')->create();
        factory(App\Department::class)->states('DBA')->create();
        factory(App\Department::class)->states('DAS')->create();
    }
}
