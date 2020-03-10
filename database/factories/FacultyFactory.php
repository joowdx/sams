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
        'program_id' => 1,
    ];
});

$factory->state(Faculty::class, 'Max', function($faker) {
    return [
        'uid' => 10000,
        'schoolid' => '91023',
        'name' => 'Maximus',
        'description' => 'i love optimists',
        'program_id' => 1,
    ];
});

$factory->state(Faculty::class, 'Min', function($faker) {
    return [
        'uid' => 10001,
        'schoolid' => '91024',
        'name' => 'Minimus',
        'description' => 'i love pessimists',
        'program_id' => 2,
    ];
});
