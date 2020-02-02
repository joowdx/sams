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

Auth::routes(['register' => false]);
Route::any('/', 'HomeController')->name('home');
Route::any('dashboard', 'DashboardController')->name('dashboard');
Route::any('profile', 'ProfileController')->name('profile');
Route::any('statistics', 'StatsController')->name('statistics');
Route::any('map', 'MapController@index')->name('map');
Route::any('calendar', 'CalendarController@index')->name('calendar');
Route::resource('academicperiods', 'AcademicPeriodController');
Route::resource('events', 'EventController');
Route::resource('courses', 'CourseController');
Route::resource('departments', 'DepartmentController');
Route::resource('students', 'StudentController');
Route::resource('faculties', 'FacultyController');
Route::resource('tags', 'UnverifiedTagController')->only('index');
Route::resource('users', 'UserController');
Route::resource('logs', 'LogController');
Route::resource('faculties.courses', 'FacultyCourseController');
Route::resource('configurations', 'ConfigurationController');
// Route::resource('courses.students', 'StudentController');
// Route::resource('faculties.courses.students', 'StudentController');
Route::resource('profiles', 'ProfileController');
Route::resource('deptheads', 'DeptHeadController');
Route::resource('studentviews', 'StudentViewController');
Route::any('test', function() {
    $course = App\Course::find(2);
    while ($day = $course->nextmeeting($day ?? $course->firstmeeting())) {
        echo "$day<br>";

        $next = $day;
    }
});
