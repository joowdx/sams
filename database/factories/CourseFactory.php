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
        'description' => '',
        'day_from' => 'Mon',
        'day_to' => $unit == 2 ? 'Thu' : 'Fri',
        'time_from' => $from,
        'time_to' => $time[array_search($from, $time) + 1],
        'units' => $unit,
        'academic_period_id' => $faker->randomElement(Period::all()->pluck('id')),
        'room_id' => $faker->randomElement(App\Reader::rooms()->pluck('id')),
        'faculty_id' => $faker->randomElement(App\Faculty::all()->pluck('id'))
    ];
});

$factory->state(Course::class, 'CCE-101', function(Faker $faker) {
    return [
        'code' => '0905',
        'title' => 'CCE-101',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '08:00',
        'time_to' => '10:00',
        'room_id' => '3'
    ];
});

$factory->state(Course::class, 'CCE-102', function(Faker $faker) {
    return [
        'code' => '0906',
        'title' => 'CCE-102',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '08:00',
        'time_to' => '10:00',
        'room_id' => '4'
    ];
});

$factory->state(Course::class, 'CCE-104', function(Faker $faker) {
    return [
        'code' => '0866',
        'title' => 'CCE-104',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '08:00',
        'time_to' => '10:00',
        'room_id' => '5'
    ];
});

$factory->state(Course::class, 'CCE-105', function(Faker $faker) {
    return [
        'code' => '0867',
        'title' => 'CCE-105',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '10:00',
        'time_to' => '12:00',
        'room_id' => '3'
    ];
});

$factory->state(Course::class, 'EE-433', function(Faker $faker) {
    return [
        'code' => '0832',
        'title' => 'EE-433',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '10:00',
        'time_to' => '12:00',
        'room_id' => '4'
    ];
});


$factory->state(Course::class, 'IT-3', function(Faker $faker) {
    return [
        'code' => '0868',
        'title' => 'IT-3',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '10:00',
        'time_to' => '12:00',
        'room_id' => '5'
    ];
});

$factory->state(Course::class, 'IT-5', function(Faker $faker) {
    return [
        'code' => '0874',
        'title' => 'IT-5',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '12:30',
        'time_to' => '14:30',
        'room_id' => '4'
    ];
});
