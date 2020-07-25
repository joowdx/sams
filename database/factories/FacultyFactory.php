<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Faculty;
use App\Program;
use Faker\Generator as Faker;

$factory->define(Faculty::class, function (Faker $faker) {
    return [
        'uid' => substr(strtoupper(str_replace('#', '', $faker->hexcolor().$faker->hexcolor())), 0, 8),
        'schoolid' => $faker->randomNumber(5, true),
        'name' => $faker->name(),
        'description' => $faker->words(20, true),
        'program_id' => $faker->randomElement(Program::all()->pluck('id')),
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
