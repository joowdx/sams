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

//DTP

$factory->state(Program::class, 'BSIT', function($faker) {
    return [
        'name' => 'Bachelor of Science in Information Technology',
        'shortname' => 'BSIT',
        'department_id' => 1,
    ];
});

$factory->state(Program::class, 'BSCpE', function($faker) {
    return [
        'name' => 'Bachelor of Science in Computer Engineering',
        'shortname' => 'BSCpE',
        'department_id' => 1,
    ];
});

//DAS

$factory->state(Program::class, 'BSPsych', function($faker) {
    return [
        'name' => 'Bachelor of Science in Psychology',
        'shortname' => 'BSPysch',
        'department_id' => 6,
    ];
});

$factory->state(Program::class, 'BSPolSci', function($faker) {
    return [
        'name' => 'Bachelor of Science in Political Science',
        'shortname' => 'BSPolSci',
        'department_id' => 6,
    ];
});

//DBA

$factory->state(Program::class, 'BSMM', function($faker) {
    return [
        'name' => 'Bachelor of Science in Marketing Management',
        'shortname' => 'BSMM',
        'department_id' => 5,
    ];
});

$factory->state(Program::class, 'BSFM', function($faker) {
    return [
        'name' => 'Bachelor of Science in Financial Management',
        'shortname' => 'BSFM',
        'department_id' => 5,
    ];
});

//DAE

$factory->state(Program::class, 'BSA', function($faker) {
    return [
        'name' => 'Bachelor of Science in Accountancy',
        'shortname' => 'BSA',
        'department_id' => 5,
    ];
});

//DCJE

$factory->state(Program::class, 'BSCrim', function($faker) {
    return [
        'name' => 'Bachelor of Science in Criminology',
        'shortname' => 'BSFM',
        'department_id' => 3,
    ];
});

//DTE

$factory->state(Program::class, 'BSED', function($faker) {
    return [
        'name' => 'Bachelor in Secondary Education',
        'shortname' => 'BSED',
        'department_id' => 2,
    ];
});

$factory->state(Program::class, 'BEED', function($faker) {
    return [
        'name' => 'Bachelor in Elementary Education',
        'shortname' => 'BEED',
        'department_id' => 2,
    ];
});

$factory->state(Program::class, 'BTTE', function($faker) {
    return [
        'name' => 'Bachelor in Technical Teachers Education',
        'shortname' => 'BTTE',
        'department_id' => 2,
    ];
});
