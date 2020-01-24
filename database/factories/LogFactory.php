<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Log;
use App\Course;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Log::class, function (Faker $faker) {
    return [

    ];
});

$it111l = null;
$it112l = null;
$jane = null;
$john = null;

$factory->state(Log::class, 'IT111L JANE', function($faker) {
    global $it111l, $jane;
    $it111l = $it111l ?? Course::find(1);
    $jane = $jane ?? $it111l->academic_period->start->setTime(explode(':', $it111l->time_from)[0], explode(':', $it111l->time_from)[1]);
    $log = $faker->dateTimeBetween($jane, $jane->format('Y-m-d H:i:s').' +30 minutes');
    $remark = $jane->copy()->addMinutes(15)->gt(Carbon::instance($log)) ? 'ok' : 'late';
    $chance = rand(1, 100);
    $jane->addDays($chance < 90 ? 1 : ($chance < 98 ? 2 : 3));
    return [
        'log_by_id' => '2',
        'log_by_type' => 'App\Student',
        'from_by_id' => '1',
        'from_by_type' => 'App\Room',
        'type' => null,
        'course_id' => '1',
        'remarks' => $remark,
        'created_at' => $log,
        'updated_at' => $log,
    ];
});

$factory->state(Log::class, 'IT111L JOHN', function($faker) {
    global $it111l, $john;
    $it111l = $it111l ?? Course::find(1);
    $john = $john ?? $it111l->academic_period->start->setTime(explode(':', $it111l->time_from)[0], explode(':', $it111l->time_from)[1]);
    $log = $faker->dateTimeBetween($john, $john->format('Y-m-d H:i:s').' +30 minutes');
    $remark = $john->copy()->addMinutes(15)->gt(Carbon::instance($log)) ? 'ok' : 'late';
    $chance = rand(1, 100);
    $john->addDays($chance < 90 ? 1 : ($chance < 98 ? 2 : 3));
    return [
        'log_by_id' => '1',
        'log_by_type' => 'App\Student',
        'from_by_id' => '1',
        'from_by_type' => 'App\Room',
        'type' => null,
        'course_id' => '1',
        'remarks' => $remark,
        'created_at' => $log,
        'updated_at' => $log,
    ];
});

$factory->state(Log::class, 'IT112L JANE', function($faker) {
    global $it112l, $jane;
    $it112l = $it112l ?? Course::find(2);
    $jane = $jane ?? $it112l->academic_period->start->setTime(explode(':', $it112l->time_from)[0], explode(':', $it112l->time_from)[1]);
    $log = $faker->dateTimeBetween($jane, $jane->format('Y-m-d H:i:s').' +30 minutes');
    $remark = $jane->copy()->addMinutes(15)->gt(Carbon::instance($log)) ? 'ok' : 'late';
    $chance = rand(1, 100);
    $jane->addDays($chance < 90 ? 1 : ($chance < 98 ? 2 : 3));
    return [
        'log_by_id' => '2',
        'log_by_type' => 'App\Student',
        'from_by_id' => '1',
        'from_by_type' => 'App\Room',
        'type' => null,
        'course_id' => '2',
        'remarks' => $remark,
        'created_at' => $log,
        'updated_at' => $log,
    ];
});

$factory->state(Log::class, 'IT112L JOHN', function($faker) {
    global $it112l, $john;
    $it112l = $it112l ?? Course::find(2);
    $john = $john ?? $it112l->academic_period->start->setTime(explode(':', $it112l->time_from)[0], explode(':', $it112l->time_from)[1]);
    $log = $faker->dateTimeBetween($john, $john->format('Y-m-d H:i:s').' +30 minutes');
    $remark = $john->copy()->addMinutes(15)->gt(Carbon::instance($log)) ? 'ok' : 'late';
    $chance = rand(1, 100);
    $john->addDays($chance < 90 ? 1 : ($chance < 98 ? 2 : 3));
    return [
        'log_by_id' => '1',
        'log_by_type' => 'App\Student',
        'from_by_id' => '1',
        'from_by_type' => 'App\Room',
        'type' => null,
        'course_id' => '2',
        'remarks' => $remark,
        'created_at' => $log,
        'updated_at' => $log,
    ];
});
