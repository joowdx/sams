<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Faculty;
use Faker\Generator as Faker;

$factory->define(Faculty::class, function (Faker $faker) {
    return [
        'uid' => $faker->randomNumber(5, true).$faker->randomNumber(6, true),
        'schoolid' => '91023',
        'name' => $faker->name(),
        'description' => 'i love bacons',
        'department_id' => 1,
    ];
});

$factory->state(Faculty::class, 'John Doe', function($faker) {
    return [
        'uid' => 10000,
        'schoolid' => '91023',
        'name' => 'John Doe',
        'description' => 'i love bacons',
        'department_id' => 1,
    ];
});
