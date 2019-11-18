<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->state(Student::class, 'John Doe', function($faker) {
    return [
        'uid' => 315828891249,
        'name' => 'John Doe',
    ];
});

$factory->state(Student::class, 'Jane Doe', function($faker) {
    return [
        'uid' => 40175168926,
        'name' => 'Jane Doe',
    ];
});
