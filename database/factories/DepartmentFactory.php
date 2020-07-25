<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    $name = ucwords($faker->words(6, true));
    $expr = '/(?<=\s|^)[a-z]/i';
    preg_match_all($expr, $name, $matches);
    return [
        'name' => $name,
        'shortname' => implode($matches[0]),
        'faculty_id' => null,
    ];
});

$factory->state(Department::class, 'DTP', function($faker) {
    return [
        'name' => 'Department of Technical Programs',
        'shortname' => 'DTP',
        'faculty_id' => 1,
    ];
});
