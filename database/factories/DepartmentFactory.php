<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->state(Department::class, 'DTP', function($faker) {
    return [
        'name' => 'Department of Technical Programs',
        'shortname' => 'DTP',
        'faculty_id' => 1,
    ];
});
