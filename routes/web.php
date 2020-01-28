<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\AcademicPeriod;
use App\Course;
use App\EventHolidays;
use App\Log;
use App\Student;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

Auth::routes(['register' => false]);
Route::any('/', 'HomeController')->name('home');
Route::any('/dashboard', 'DashboardController')->name('dashboard');
Route::any('/profile', 'ProfileController')->name('profile');
Route::any('/statistics', 'StatsController')->name('statistics');
Route::resource('academicperiods', 'AcademicPeriodController');
Route::resource('courses', 'CourseController');
Route::resource('students', 'StudentController');
Route::resource('faculties', 'FacultyController');
Route::resource('profiles', 'ProfileController');
Route::resource('deptheads', 'DeptHeadController');
Route::resource('studentviews', 'StudentViewController');
// Route::resource('courses.students', 'StudentController');
// Route::resource('faculties.courses', 'CourseController');
// Route::resource('faculties.courses.students', 'StudentController');
Route::resource('logs', 'LogController');
Route::resource('users', 'UserController');
Route::resource('configurations', 'ConfigurationController');
Route::resource('events', 'EventController');
Route::any('calendar', 'CalendarController@index')->name('calendar');
Route::any('map', 'MapController@index')->name('map');
Route::any('test', function() {
});
