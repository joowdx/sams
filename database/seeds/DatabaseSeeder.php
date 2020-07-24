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
            EventSeeder::class,
            // DepartmentSeeder::class,
            // ProgramSeeder::class,
            // FacultySeeder::class,
            // StudentSeeder::class,
            // ReaderSeeder::class,
            // AcademicPeriodSeeder::class,
            // CourseSeeder::class,
            // EventSeeder::class,
            // LogSeeder::class,
        ]);
    }
}
