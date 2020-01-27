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
Route::resource('events', 'EventController');
Route::any('calendar', 'CalendarController@index')->name('calendar');
Route::any('map', 'MapController@index')->name('map');
Route::any('test', function() {



    $x = 21;

    function t(&$x) {
        $x = 99;
    }

    function x() {
        global $x;
        t($x);
    }
    t($x);
    return $x;


    $week = [
        'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun',
    ];

    foreach($week as $n => $d) {
        echo $n.$d."<br>";
    }
    return;
    return Course::whereIn('academic_period_id',
    AcademicPeriod::where(function($query) {
        $query->whereDate('start', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
    })->get()->map(function($period) {
        return $period->id;
    })->all()
)->with(['students', 'logs'])->get();
    // $l = ($course = Course::first())->logs()->where([
    //     'log_by_id' => ($student = Student::first())->id,
    //     'log_by_type' => get_class($student),
    // ])->get();
    // echo $l;
    // return;
    // array_diff(
    //     iterator_to_array(
    //         CarbonPeriod::create(
    //             Course::first()->academic_period->start, date('Y-m-d')
    //         )->filter(function($day) {
    //             return $day->isWeekDay();
    //         })->map(function($day) {
    //             return $day->format('Y-m-d');
    //         })
    //     ),
    //     DB::table('ended_classes')->where([
    //         'course_id' => 1,
    //     ])->get()->map(function($day) {
    //         return $day->date;
    //     })->all()
    // );


    return ;
    // return array_get
    $c =  Course::whereIn('academic_period_id',
        AcademicPeriod::where(function($query) {
            $query->whereDate('start', '<=', date('Y-m-d'))->whereDate('end', '>=', date('Y-m-d'));
        })->get()->map(function($period) {
            return $period->id;
        })->all()
    )->whereTime('time_to', '<', date('H:i'))->with('students')->get();




    return iterator_to_array(CarbonPeriod::create($c[0]->academic_period->start, $c[0]->academic_period->end)->filter(function($day) { return $day->isWeekDay(); })->map(function($day) { return $day->format('D d-m-y'); }));

    // return array_diff($y, $z);

    // ->whereTime('time_from', '<=', date('H:i'))->whereTime('time_to', '>', date('H:i'))->get();
});
