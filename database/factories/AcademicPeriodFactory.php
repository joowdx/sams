<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AcademicPeriod;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(AcademicPeriod::class, function (Faker $faker) {

    $sy = $faker->randomElement(['2019-2020', '2020-2021']);
    $sm = $faker->randomElement(['1ST, 2ND, SUMMER']);
    $tm = ($sm == 'SUMMER') ? 'SUMMER' : $faker->randomElement(['1ST', '2ND', 'SEMESTER']);

    switch ($tm) {
        case '1ST': {
            $st = ($sm == '1ST') ? Carbon::createFromFormat('m-d-Y', '01-06-'.explode('-', $sy)[0]) : Carbon::createFromFormat('m-d-Y', '01-11-'.explode('-', $sy)[0]);
            $en = ($sm == '1ST') ? Carbon::createFromFormat('m-d-Y', '18-08-'.explode('-', $sy)[0]) : Carbon::createFromFormat('m-d-Y', '31-03-'.explode('-', $sy)[1]);
            break;
        }
        case '2ND': {
            $st = ($sm == '1ST') ? Carbon::createFromFormat('m-d-Y', '19-08-'.explode('-', $sy)[0]) : Carbon::createFromFormat('m-d-Y', '01-11-'.explode('-', $sy)[0]);
            $en = ($sm == '1ST') ? Carbon::createFromFormat('m-d-Y', '31-10-'.explode('-', $sy)[0]) : Carbon::createFromFormat('m-d-Y', '31-03-'.explode('-', $sy)[1]);
            break;
        }
        case 'SEMESTER': {
            $st = ($sm == '1ST') ? Carbon::createFromFormat('m-d-Y', '01-06-'.explode('-', $sy)[0]) : Carbon::createFromFormat('m-d-Y', '01-11-'.explode('-', $sy)[0]);
            $en = ($sm == '1ST') ? Carbon::createFromFormat('m-d-Y', '31-10-'.explode('-', $sy)[0]) : Carbon::createFromFormat('m-d-Y', '31-03-'.explode('-', $sy)[1]);
            break;
        }
        case 'SUMMER': {
            $st = Carbon::createFromFormat('m-d-Y', '01-04-'.explode('-', $sy)[0]);
            $en = Carbon::createFromFormat('m-d-Y', '31-05-'.explode('-', $sy)[0]);
            break;
        }
    }

    return [
        'school_year' => $sy,
        'semester' => $sm,
        'term' => $tm,
        'start' => $st,
        'end' => $en,
    ];
});


$factory->state(AcademicPeriod::class, 'SEMESTER', function(Faker $faker) {
    return [
        'school_year'  => '2020-2021',
        'semester' => '1ST',
        'term' => 'SEMESTER',
        'start' => Carbon::createFromFormat('d-m-y', '20-07-20'),
        'end' => Carbon::createFromFormat('d-m-y', '19-12-20'),
    ];
});

$factory->state(AcademicPeriod::class, '1TERM', function(Faker $faker) {
    return [
        'school_year'  => '2020-2021',
        'semester' => '1ST',
        'term' => '1ST',
        'start' => Carbon::createFromFormat('d-m-y', '20-07-20'),
        'end' => Carbon::createFromFormat('d-m-y', '12-09-20'),
    ];
});

$factory->state(AcademicPeriod::class, '2TERM', function(Faker $faker) {
    return [
        'school_year'  => '2020-2021',
        'semester' => '1ST',
        'term' => '2ND',
        'start' => Carbon::createFromFormat('d-m-y', '14-09-20'),
        'end' => Carbon::createFromFormat('d-m-y', '19-12-20'),
    ];
});
