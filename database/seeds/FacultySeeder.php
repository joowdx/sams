<?php

use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Faculty::class)->states('D')->create();
        factory(App\Faculty::class)->states('P')->create();
        factory(App\Faculty::class)->states('J')->create();
        factory(App\Faculty::class)->states('N')->create();
        factory(App\Faculty::class)->states('R')->create();
        factory(App\Faculty::class)->states('F')->create();
    }
}
