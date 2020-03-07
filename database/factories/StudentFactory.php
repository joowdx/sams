<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        // 'uid' => $faker->random->,
        'name' => $faker->name,
    ];
});

$factory->state(Student::class, 'John Doe', function($faker) {
    return [
        'uid' => 315828891249,
        'schoolid' => '45678',
        'name' => 'John Doe',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Jane Doe', function($faker) {
    return [
        'uid' => 40175168926,
        'schoolid' => '56789',
        'name' => 'Jane Doe',
        'program_id' => 1,
    ];
});
