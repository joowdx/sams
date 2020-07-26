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

$factory->state(Faculty::class, 'P', function($faker) {
    return [
        'name' => 'Eduard Pulvera',
        'description' => '',
        'program_id' => 1,
    ];
});

$factory->state(Faculty::class, 'D', function($faker) {
    return [
        'name' => 'Cyvil Dave Dasargo',
        'description' => '',
        'program_id' => 1,
    ];
});

$factory->state(Faculty::class, 'J', function($faker) {
    return [
        'name' => 'Joane May Delima',
        'description' => '',
        'program_id' => 1,
    ];
});

$factory->state(Faculty::class, 'N', function($faker) {
    return [
        'name' => 'Nesle Tagalog',
        'description' => '',
        'program_id' => 1,
    ];
});

$factory->state(Faculty::class, 'R', function($faker) {
    return [
        'name' => 'Raven Manulat',
        'description' => '',
        'program_id' => 1,
    ];
});

$factory->state(Faculty::class, 'F', function($faker) {
    return [
        'name' => 'Rheyan Fritz Gonzales',
        'description' => '',
        'program_id' => 1,
    ];
});
