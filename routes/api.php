<?php

use App\EventHolidays;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('logs', 'API\LogController');
Route::any('tags', 'API\TagController');
Route::resource('users', 'API\Usercontroller');
Route::resource('faculties', 'API\FacultyController');
Route::resource('students', 'API\StudentController');
Route::resource('courses', 'API\CourseController');
Route::any('statsclass', 'API\StatsClassController');
Route::any('records', 'API\RecordsController')->name('records');
Route::any('queryclasses', 'API\ClassesQueryController')->name('queryclasses');
Route::any('events', 'API\EventController')->name('events');
Route::any('attendance', 'API\AttendanceController')->name('attendance');
Route::any('search', 'API\Search')->name('search');
Route::any('newtag', 'API\TagController@newtag')->name('newtag');
