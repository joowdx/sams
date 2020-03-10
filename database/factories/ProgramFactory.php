<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Program;
use Faker\Generator as Faker;

$factory->define(Program::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->state(Program::class, 'BSIT', function($faker) {
    return [
        'name' => 'Bachelor of Science in Information Technology',
        'shortname' => 'BSIT',
        'faculty_id' => 2,
        'department_id' => 1,
    ];
});

$factory->state(Program::class, 'BSCpE', function($faker) {
    return [
        'name' => 'Bachelor of Science in Computer Engineering',
        'shortname' => 'BSCpE',
        'faculty_id' => 1,
        'department_id' => 1,
    ];
});

