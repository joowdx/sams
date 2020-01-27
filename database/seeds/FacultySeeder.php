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
        echo 'Creating dummy faculty John Doe...';
        factory(App\Faculty::class)->states(['John Doe'])->create();
    }
}
