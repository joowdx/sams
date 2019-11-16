<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Faculty;
use Faker\Generator as Faker;

$factory->define(Faculty::class, function (Faker $faker) {
    return [
        'uid' => $faker->randomNumber(5, true).$faker->randomNumber(6, true),
        'name' => $faker->name(),
    ];
});

$factory->state(Faculty::class, 'John Doe', function($faker) {
    return [
        'uid' => 10000,
        'name' => 'John Doe',
    ];
});
