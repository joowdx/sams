<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Faculty;
use Faker\Generator as Faker;

$factory->define(Faculty::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->state(Faculty::class, 'John Doe', function($faker) {
    return [
        'uid' => 10000,
        'name' => 'John Doe',
    ];
});
