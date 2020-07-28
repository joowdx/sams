<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Program;
use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'uid' => substr(strtoupper(str_replace('#', '', $faker->hexcolor().$faker->hexcolor())), 0, 8),
        'schoolid' => $faker->randomNumber(5, true),
        'name' => $faker->name,
    ];
});

$factory->state(Student::class, 'Bryan Bolo', function($faker) {
    return [
        'schoolid' => '50426',
        'name' => 'Bryan Bolo',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Jude Pineda', function($faker) {
    return [
        'schoolid' => '47691',
        'name' => 'Jude Pineda',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Gene Philip Rellanos', function($faker) {
    return [
        'schoolid' => '50386',
        'name' => 'Gene Philip Rellanos',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Amilissa Araneta', function($faker) {
    return [
        'schoolid' => '50491',
        'name' => 'Amilissa Araneta',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'John Lloyd Casia', function($faker) {
    return [
        'schoolid' => '50439',
        'name' => 'John Lloyd Casia',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'James Andrew Dignadice', function($faker) {
    return [
        'schoolid' => '50032',
        'name' => 'James Andrew Dignadice',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Jean Nikolai Roxas', function($faker) {
    return [
        'schoolid' => '50492',
        'name' => 'Jean Nikolai Roxas',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Dhominic Arendain', function($faker) {
    return [
        'schoolid' => '48077',
        'name' => 'Dhominic Arendain',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Geraldin Cayode', function($faker) {
    return [
        'schoolid' => '50408',
        'name' => 'Geraldin Cayode',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Luigi Dimagnaong', function($faker) {
    return [
        'schoolid' => '50445',
        'name' => 'Luigi Dimagnaong',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Axel John Abear', function($faker) {
    return [
        'schoolid' => '50831', //////////
        'name' => 'Axel John Abear',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Bernadette Allion', function($faker) {
    return [
        'schoolid' => '49173', ///////////////
        'name' => 'Bernadette Allion',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Jamil Beltran', function($faker) {
    return [
        'schoolid' => '50863', ///////////////
        'name' => 'Jamil Beltran',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Ian Joey Cobol', function($faker) {
    return [
        'schoolid' => '56731', ///////////////
        'name' => 'Ian Joey Cobol',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Yvvone Love Decina', function($faker) {
    return [
        'schoolid' => '50124', ///////////////
        'name' => 'Yvvone Love Decina',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'King Carlo Dela Cerna', function($faker) {
    return [
        'schoolid' => '49913', ///////////////
        'name' => 'King Carlo Dela Cerna',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Steven Glenn Gabihan', function($faker) {
    return [
        'schoolid' => '50451', ///////////////
        'name' => 'Steven Glenn Gabihan',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Christian Lloyd Lape', function($faker) {
    return [
        'schoolid' => '51000', ///////////////
        'name' => 'Christian Lloyd Lape',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Archeval Laran', function($faker) {
    return [
        'schoolid' => '45138', ///////////////
        'name' => 'Archeval Laran',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Annie Rose Leopardas', function($faker) {
    return [
        'schoolid' => '49831', ///////////////
        'name' => 'Annie Rose Leopards',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Mark Anthony Libres', function($faker) {
    return [
        'schoolid' => '40958', ///////////////
        'name' => 'Mark Anthony Libres',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Josebelle Linggoan', function($faker) {
    return [
        'schoolid' => '48673', ///////////////
        'name' => 'Josebelle Linggoan',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Francis Fritz Nequin', function($faker) {
    return [
        'schoolid' => '48537', ///////////////
        'name' => 'Francis Fritz Nequin',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Jasson Nequin', function($faker) {
    return [
        'schoolid' => '43139', ///////////////
        'name' => 'Jasson Nequin',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Armando Gabriel Nieve', function($faker) {
    return [
        'schoolid' => '39850', ///////////////
        'name' => 'Armando Gabriel Nieve',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Rachel Grace Pulvera', function($faker) {
    return [
        'schoolid' => '49993', ///////////////
        'name' => 'Rachel Grace Pulvera',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Arnulfo Sienes', function($faker) {
    return [
        'schoolid' => '49031', ///////////////
        'name' => 'Arnulfo Sienes',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Jann Sobejana', function($faker) {
    return [
        'schoolid' => '53981', ///////////////
        'name' => 'Jann Sobejana',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'John Michael Tecson', function($faker) {
    return [
        'schoolid' => '50983', ///////////////
        'name' => 'John Michael Tecson',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Jade Michael Tenorio', function($faker) {
    return [
        'schoolid' => '50133', ///////////////
        'name' => 'Jade Michael Tenorio',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Michael Angelo Torrepalma', function($faker) {
    return [
        'schoolid' => '54343', ///////////////
        'name' => 'Michaek Angelo Torrepalma',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Vincent Romeo Vivas', function($faker) {
    return [
        'schoolid' => '46789', ///////////////
        'name' => 'Vincent Romeo Vivas',
        'program_id' => 1,
    ];
});

$factory->state(Student::class, 'Karl Lyle Balbuena', function($faker) {
    return [
        'program_id' => 1,
        'schoolid' => '49831', ///////////////
        'name' => 'Karl Lyle Balbuena',
    ];
});

$factory->state(Student::class, 'Jay Lord Largo', function($faker) {
    return [
        'schoolid' => '48889', ///////////////
        'name' => 'Jay Lord Largo',
        'program_id' => 1,
    ];
});


