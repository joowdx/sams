<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reader;
use Faker\Generator as Faker;

$factory->define(Reader::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->state(Reader::class, 'CL1', function($faker) {
    return [
        'name' => 'CL1',
        'type' => 'room'
    ];
});

$factory->state(Reader::class, 'CL2', function($faker) {
    return [
        'name' => 'CL2',
        'type' => 'room'
    ];
});

$factory->state(Reader::class, 'CL3', function($faker) {
    return [
        'name' => 'CL3',
        'type' => 'room'
    ];
});

$factory->state(Reader::class, 'G1', function($faker) {
    return [
        'name' => 'G1',
        'type' => 'gate'
    ];
});

$factory->state(Reader::class, 'G2', function($faker) {
    return [
        'name' => 'G2',
        'type' => 'gate'
    ];
});
