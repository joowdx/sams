<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Log;
use App\Course;
use App\Student;
use App\Faculty;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Log::class, function (Faker $faker) {
    return [

    ];
});

$it111l = null;
$it112l = null;
$fclt = null;
$john = null;
$jane = null;
$it111lfclt = null;
$it111ljane = null;
$it112ljane = null;
$it111lfclt = null;
$it111ljohn = null;
$it112ljohn = null;

function generate($faker, $subj, $for, $day) {
    $log = $faker->dateTimeBetween($day, $day->format('Y-m-d H:i:s').' +20 minutes');
    $remark = rand(1, 100) > 90 ? 'absent' : ($day->copy()->addMinutes(15)->gt(Carbon::instance($log)) ? 'ok' : 'late');
    return [
        'log_by_id' => $for->id,
        'log_by_type' => get_class($for),
        'reader_id' => $remark == 'absent' ? null : $subj->room->id,
        'course_id' => $subj->id,
        'remarks' => $remark,
        'date' => $log,
        'created_at' => $log,
    ];
}

$factory->state(Log::class, 'IT111L FCLT', function($faker) {
    global $it111l, $fclt, $it111lfclt;
    $it111l = $it111l ?? Course::find(1);
    $fclt = $fclt ?? Faculty::find(1);
    $it111lfclt = $it111l->nextmeeting($it111lfclt ?? $it111l->firstmeeting()->subDays(1));
    return generate($faker, $it111l, $fclt, $it111lfclt);
});

$factory->state(Log::class, 'IT112L FCLT', function($faker) {
    global $it112l, $fclt, $it112lfclt;
    $it112l = $it112l ?? Course::find(2);
    $fclt = $fclt ?? Faculty::find(1);
    $it112lfclt = $it112l->nextmeeting($it112lfclt ?? $it112l->firstmeeting()->subDays(1));
    return generate($faker, $it112l, $fclt, $it112lfclt);
});

$factory->state(Log::class, 'IT111L JOHN', function($faker) {
    global $it111l, $john, $it111ljohn;
    $it111l = $it111l ?? Course::find(1);
    $john = $john ?? Student::find(1);
    $it111ljohn = $it111l->nextmeeting($it111ljohn ?? $it111l->firstmeeting()->subDays(1));
    return generate($faker, $it111l, $john, $it111ljohn);
});

$factory->state(Log::class, 'IT111L JANE', function($faker) {
    global $it111l, $jane, $it111ljane;
    $it111l = $it111l ?? Course::find(1);
    $jane = $jane ?? Student::find(2);
    $it111ljane = $it111l->nextmeeting($it111ljane ?? $it111l->firstmeeting()->subDays(1));
    return generate($faker, $it111l, $jane, $it111ljane);
});

$factory->state(Log::class, 'IT112L JOHN', function($faker) {
    global $it112l, $john, $it112ljohn;
    $it112l = $it112l ?? Course::find(2);
    $john = $john ?? Student::find(1);
    $it112ljohn = $it112l->nextmeeting($it112ljohn ?? $it112l->firstmeeting()->subDays(1));
    return generate($faker, $it112l, $john, $it112ljohn);
});

$factory->state(Log::class, 'IT112L JANE', function($faker) {
    global $it112l, $jane, $it112ljane;
    $it112l = $it112l ?? Course::find(2);
    $jane = $jane ?? Student::find(2);
    $it112ljane = $it112l->nextmeeting($it112ljane ?? $it112l->firstmeeting()->subDays(1));
    return generate($faker, $it112l, $jane, $it112ljane);
});
