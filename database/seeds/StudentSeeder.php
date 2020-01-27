<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'Creating dummy student John Doe...';
        factory(App\Student::class)->states(['John Doe'])->create();
        echo 'Creating dummy student Jane Doe...';
        factory(App\Student::class)->states(['Jane Doe'])->create();
    }
}
