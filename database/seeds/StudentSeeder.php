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
        factory(App\Student::class)->states('Bryan Bolo')->create();
        factory(App\Student::class)->states('Jude Pineda')->create();
        factory(App\Student::class)->states('Gene Philip Rellanos')->create();
    }
}
