<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\AcademicPeriod as Period;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $unit = $faker->randomElement([2, 3, 6, 9]);
    $time = [
        '07:00','08:00','09:00','10:00','11:00','12:30','13:30','14:30','15:30','16:30','17:30',
    ];
    $from = $faker->randomElement(array_splice($time, -1));

    return [
        'code' => $faker->randomNumber(4, true),
        'title' => substr($faker->word(), 0, 7),
        'description' => $faker->words(5, true),
        'day_from' => 'Mon',
        'day_to' => $unit == 2 ? 'Thu' : 'Fri',
        'time_from' => $from,
        'time_to' => $time[array_search($from, $time) + 1],
        'units' => $unit,
        'academic_period_id' => $faker->randomElement(Period::all()->pluck('id')),
        'room_id' => $faker->randomElement(App\Reader::all()->pluck('id')),
        'faculty_id' => $faker->randomElement(App\Faculty::all()->pluck('id'))
    ];
});

$factory->state(Course::class, 'IT111L', function(Faker $faker) {
    return [
        'code' => 1000,
        'title' => 'IT111L',
        'description' => 'Basic Computer Operations',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '15:30',
        'time_to' => '17:30',
        'units' => 6,
        'room_id' => 3,
        'faculty_id' => 1,
    ];
});

$factory->state(Course::class, 'IT112L', function(Faker $faker) {
    return [
        'code' => 1001,
        'title' => 'IT112L',
        'description' => 'Basic Programming',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '13:30',
        'time_to' => '15:30',
        'units' => 6,
        'room_id' => 4,
        'faculty_id' => 1,
    ];
});
