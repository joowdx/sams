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
        factory(App\Faculty::class)->states(['Max'])->create();
        factory(App\Faculty::class)->states(['Min'])->create();
    }
}
