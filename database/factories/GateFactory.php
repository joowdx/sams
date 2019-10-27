<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gate;
use Faker\Generator as Faker;

$factory->define(Gate::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->state(Gate::class, 'G1', function($faker) {
    return [
        'name' => 'G1',
    ];
});

$factory->state(Gate::class, 'G2', function($faker) {
    return [
        'name' => 'G1',
    ];
});
