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
        'hexcolor' => '3A3A3A', //Grey
    ];
});

$factory->state(Department::class, 'DTE', function($faker) {
    return [
        'name' => 'Department of Teachers Education',
        'shortname' => 'DTE',
        'hexcolor' => '084177', //Blue
    ];
});


$factory->state(Department::class, 'DAE', function($faker) {
    return [
        'name' => 'Department of Accounting Education',
        'shortname' => 'DAE',
        'hexcolor' => '800000' //Maroon
    ];
});

$factory->state(Department::class, 'DBA', function($faker) {
    return [
        'name' => 'Department of Business Administration',
        'shortname' => 'DBA',
        'hexcolor' => 'F5A31A' //Yellow Orange
    ];
});

$factory->state(Department::class, 'DCJE', function($faker) {
    return [
        'name' => 'Department of Criminal Justice Education',
        'shortname' => 'DCJE',
        'hexcolor' => 'CF1B1B' //Red
    ];
});

$factory->state(Department::class, 'DAS', function($faker) {
    return [
        'name' => 'Department of Arts and Sciences',
        'shortname' => 'DAS',
        'hexcolor' => '2B580C' //Green
    ];
});
