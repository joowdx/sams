<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->state(Room::class, 'CL1', function($faker) {
    return [
        'name' => 'CL1',
    ];
});

$factory->state(Room::class, 'CL2', function($faker) {
    return [
        'name' => 'CL2',
    ];
});

$factory->state(room::class, 'CL3', function($faker) {
    return [
        'name' => 'CL3',
    ];
});
