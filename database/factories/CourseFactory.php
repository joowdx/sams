<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(4, true),
        'title' => $faker->word(),
        'description' => $faker->words(5, true),
        'semester' => $faker->randomElement(['1ST', '2ND', 'SUMMER']),
        'term' => $faker->randomElement(['1ST', '2ND', 'SEMESTER']),
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '15:30',
        'time_to' => '17:30',
        'units' => $faker->randomElement([2, 3, 6, 9]),
    ];
});

$factory->state(Course::class, 'IT111L', function(Faker $faker) {
    return [
        'code' => 1000,
        'title' => 'IT112L',
        'description' => 'Basic Computer Operations',
        'semester' => '1ST',
        'term' => 'SEMESTER',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '15:30',
        'time_to' => '17:30',
        'units' => 6,
        'room_id' => 1,
        'faculty_id' => 1,
    ];
});

$factory->state(Course::class, 'IT112L', function(Faker $faker) {
    return [
        'code' => 1001,
        'title' => 'IT112L',
        'description' => 'Basic Programming',
        'semester' => '2ND',
        'term' => 'SEMESTER',
        'day_from' => 'Mon',
        'day_to' => 'Fri',
        'time_from' => '13:30',
        'time_to' => '15:30',
        'units' => 6,
        'room_id' => 1,
        'faculty_id' => 1,
    ];
});
