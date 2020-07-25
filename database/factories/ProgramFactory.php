<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Program;
use Faker\Generator as Faker;

$factory->define(Program::class, function (Faker $faker) {
    $name = ucwords($faker->words(6, true));
    $expr = '/(?<=\s|^)[a-z]/i';
    preg_match_all($expr, $name, $matches);
    return [
        'name' => $name,
        'shortname' => implode($matches[0]),
        'department_id' => $faker->randomElement(App\Department::all()->pluck('id')),
        'faculty_id' => null,
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

