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
        // $it111l = factory(App\Course::class)->states(['IT111L'])->create();
        // $it111l->academic_period()->associate(App\AcademicPeriod::first())->save();
        // $it111l->students()->sync(App\Student::all());
        // $it112l = factory(App\Course::class)->states(['IT112L'])->create();
        // $it112l->academic_period()->associate(App\AcademicPeriod::first())->save();
        // $it112l->students()->sync(App\Student::all());
        factory(App\Course::class)->states('CCE-101')->create()->students()->sync(App\Student::all());
        factory(App\Course::class)->states('CCE-102')->create()->students()->sync(App\Student::all());
        factory(App\Course::class)->states('CCE-104')->create()->students()->sync(App\Student::all());
        factory(App\Course::class)->states('CCE-105')->create()->students()->sync(App\Student::all());
        factory(App\Course::class)->states('EE-433')->create()->students()->sync(App\Student::all());
        factory(App\Course::class)->states('IT-3')->create()->students()->sync(App\Student::all());
        factory(App\Course::class)->states('IT-5')->create()->students()->sync(App\Student::all());

    }
}
