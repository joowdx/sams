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
        'uid' => 459707917051,
        'name' => 'John Doe',
    ];
});
