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
        factory(App\Student::class)->states(['John Doe'])->create();
        factory(App\Student::class)->states(['Jane Doe'])->create();
    }
}
