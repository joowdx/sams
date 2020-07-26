<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Program;
use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'uid' => substr(strtoupper(str_replace('#', '', $faker->hexcolor().$faker->hexcolor())), 0, 8),
        'schoolid' => $faker->randomNumber(5, true),
        'name' => $faker->name,
    ];
});

$factory->state(Student::class, 'Bryan Bolo', function($faker) {
    return [
        'schoolid' => '50426',
        'name' => 'Bryan Bolo',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Jude Pineda', function($faker) {
    return [
        'schoolid' => '47691',
        'name' => 'Jude Pineda',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Gene Philip Rellanos', function($faker) {
    return [
        'schoolid' => '50386',
        'name' => 'Gene Philip Rellanos',
        'program_id' => 1,
    ];
});


