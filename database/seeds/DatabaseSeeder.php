<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            // EventSeeder::class,
            AcademicPeriodSeeder::class,
            DepartmentSeeder::class,
            ProgramSeeder::class,
            FacultySeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
            ReaderSeeder::class,
            // EventSeeder::class,
            // LogSeeder::class,
        ]);
    }
}
