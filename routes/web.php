
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

use App\Course;
use App\Log;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Auth::routes(['register' => false]);
Route::middleware(['auth'])->group(function() {
    Route::permanentRedirect('/', 'dashboard');
    Route::permanentRedirect('/home', 'dashboard');
    Route::any('dashboard', 'DashboardController')->name('dashboard');
    Route::any('profile', 'ProfileController')->name('profile');
    // Route::any('statistics', 'StatsController')->name('statistics');
    Route::any('attendance', 'AttendanceController')->name('attendance');
    Route::any('map', 'MapController@index')->name('map');
    Route::any('calendar', 'CalendarController')->name('calendar');
    Route::resource('settings', 'SettingsController')->only(['index', 'store', 'update']);
    Route::resource('tags', 'TagController')->only(['index', 'store']);
    Route::resource('readers', 'ReaderController');
    Route::resource('academicperiods', 'AcademicPeriodController');
    Route::resource('events', 'EventController');
    Route::resource('courses', 'CourseController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('programs', 'ProgramController');
    Route::resource('students', 'StudentController');
    Route::resource('faculties', 'FacultyController');
    Route::resource('users', 'UserController');
    Route::resource('logs', 'LogController');
    Route::resource('faculties.courses', 'FacultyCourseController');
    Route::resource('configurations', 'ConfigurationController');
    // Route::resource('courses.students', 'StudentController');
    // Route::resource('faculties.courses.students', 'StudentController');
    Route::resource('profiles', 'ProfileController');
    Route::resource('deptheads', 'DeptHeadController');
    Route::resource('studentviews', 'StudentViewController');
    Route::get('gate1', 'GateController@gate1');
    Route::get('gate2', 'GateController@gate2');
});
Route::get('studentauth', 'StudentController@authenticate')->name('studentauth');
Route::any('x/{id}', 'StudentXcontroller')->name('xst')->middleware('guest');
Route::any('test', function() {
    $courses = Course::whereIn('academic_period_id', Period::period($request->schoolyear, $request->semester))->get();

        $students = Student::whereIn('id', $courses->flatMap(function($course) {
            return $course->students;
        })->pluck('id')->unique())->with(['courses' => function($query) use($courses) {
            $query->whereIn('id', $courses->pluck('id'));
        }])->get();
    // $f = App\Program::where(['department_id' => 1])->with(['faculties', 'faculties.courses', 'faculties.program', 'faculties.program.department'])->get()->pluck('faculties')[0];
    // return $f;
    // DB::table('logs')->truncate();
    // DB::table('ended_classes')->truncate();
    // $ended = [];
    //     $logs = [];
    //     foreach(
    //         Course::currentcourses()->load(['faculty', 'students', 'logs'])
    //     as $course) {
    //         foreach(
    //             array_diff(
    //                 iterator_to_array(
    //                     CarbonPeriod::create(
    //                         $course->academic_period->start, date('Y-m-d')
    //                     )->filter(function($day) use($course) {
    //                         return !$course->noclass($day);
    //                     })->map(function($day) {
    //                         return $day->format('Y-m-d');
    //                     })
    //                 ),
    //                 DB::table('ended_classes')->where([
    //                     'course_id' => $course->id,
    //                 ])->get()->map(function($day) {
    //                     return $day->date;
    //                 })->all()
    //             )
    //         as $day) {
    //             if(!$course->forchecking(Carbon::create($day))) {
    //                 continue;
    //             }
    //             if(
    //                 !$course->logs()->where([
    //                     'log_by_id' => $course->faculty->id,
    //                     'log_by_type' => get_class($course->faculty),
    //                 ])->whereDate('date', $day)->first()
    //             ) {
    //                 $logs[] = [
    //                     'log_by_id' => $course->faculty->id,
    //                     'log_by_type' => get_class($course->faculty),
    //                     'course_id' => $course->id,
    //                     'date' => $day,
    //                     'remarks' => 'absent',
    //                     'process' => 'auto',
    //                 ];
    //             }
    //             foreach($course->students as $student) {
    //                 if(
    //                     !$course->logs()->where([
    //                         'log_by_id' => $student->id,
    //                         'log_by_type' => get_class($student),
    //                     ])->whereDate('date', $day)->first()
    //                 ) {
    //                     $logs[] = [
    //                         'log_by_id' => $student->id,
    //                         'log_by_type' => get_class($student),
    //                         'course_id' => $course->id,
    //                         'date' => $day,
    //                         'remarks' => 'absent',
    //                         'process' => 'auto',
    //                     ];
    //                 }
    //             }
    //             $ended[] = [
    //                 'course_id' => $course->id,
    //                 'date' => $day,
    //             ];
    //         }
    //     }
    //     // return response()->json($logs);
    //     DB::table('ended_classes')->insert($ended);
    //     DB::table('logs')->insert($logs);
});
