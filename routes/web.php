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
Route::any('/dashboard', 'DashboardController')->name('dashboard');
Route::any('/profile', 'ProfileController')->name('profile');
Route::resource('academicperiods', 'AcademicPeriodController');
Route::resource('courses', 'CourseController');
Route::resource('students', 'StudentController');
Route::resource('faculties', 'FacultyController');
// Route::resource('courses.students', 'StudentController');
// Route::resource('faculties.courses', 'CourseController');
// Route::resource('faculties.courses.students', 'StudentController');
Route::resource('logs', 'LogController');
Route::resource('users', 'UserController');
Route::resource('configurations', 'ConfigurationController');
Route::any('calendar', function() { return view('calendar'); } )->name('calendar');
Route::any('map', function() { return view('map'); } )->name('map');
