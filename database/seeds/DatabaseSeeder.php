<?php

use App\AcademicPeriod;
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
            FacultySeeder::class,
            StudentSeeder::class,
            GateSeeder::class,
            RoomSeeder::class,
            AcademicPeriodSeeder::class,
            CourseSeeder::class,
        ]);
    }
}
