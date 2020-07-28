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
            StudentSeeder::class,
            CourseSeeder::class,
            ReaderSeeder::class,
            LogSeeder::class,
        ]);
    }
}
