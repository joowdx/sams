<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'Generating IT111L course...';
        $it111l = factory(App\Course::class)->states(['IT111L'])->create();
        $it111l->academic_period()->associate(App\AcademicPeriod::first())->save();
        $it111l->students()->sync(App\Student::all());
        echo 'Generating IT112L course...';
        $it112l = factory(App\Course::class)->states(['IT112L'])->create();
        $it112l->academic_period()->associate(App\AcademicPeriod::first())->save();
        $it112l->students()->sync(App\Student::all());
    }
}
