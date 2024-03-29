<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'type' => 'admin',
    ];
});

$factory->state(User::class, 'admin', function($faker) {
    return [
        'name' => 'Administrator',
        'username' => 'admin',
        'phone' => '+639'.$faker->randomNumber(9),
        'email' => 'admin@local.host',
        'type' => 'admin',
        'password' => Hash::make('root'),
    ];
});

$factory->state(User::class, 'g1', function($faker) {
    return [
        'name' => 'guard1',
        'username' => 'guard1',
        'phone' => '+639'.$faker->randomNumber(9),
        'email' => 'guard1@local.host',
        'type' => 'security1',
        'password' => Hash::make('root'),
    ];
});

$factory->state(User::class, 'g2', function($faker) {
    return [
        'name' => 'guard2',
        'username' => 'guard2',
        'phone' => '+639'.$faker->randomNumber(9),
        'email' => 'guard2@local.host',
        'type' => 'security2',
        'password' => Hash::make('root'),
    ];
});
