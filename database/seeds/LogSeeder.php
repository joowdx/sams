<?php

use App\Course;
use App\Faculty;
use App\Log;
use App\Student;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->truncate();
        DB::table('ended_classes')->truncate();
        Course::all()->filter(function($course) {
            return $course->ongoing();
        })->each(function($course) {
            $days = CarbonPeriod::create(
                $course->academic_period->start, date('Y-m-d')
            )->filter(function($day) use($course) {
                return !$course->noclass($day);
            })->filter(function($day) {
                return $day->lt(today());
            });
            foreach($days as $day) {
                if(mt_rand(0, 100) > 95) {
                    factory(Log::class)->create([
                        'log_by_type' => Faculty::class,
                        'log_by_id' => $course->faculty->id,
                        'course_id' => $course->id,
                        'reader_id' => $course->room->id,
                        'date' => $day,
                        'created_at' => $day,
                        'remarks' => 'absent'
                    ]);
                    continue;
                }
                $timelength = today()->setTimeFrom($course->time_from)->diffInMinutes(today()->setTimeFrom($course->time_to));
                $delay = mt_rand(0, 10);
                $duration = mt_rand(0, $timelength) - $delay;
                $range = collect(range($delay - 5, $timelength - 5));
                // dd($timelength, $duration, $timelength - $duration);
                // $range->splice(0, $timelength - $duration);
                // dd($range);
                for($i = $timelength - $duration; $i > 0; $i--) {
                    $range->pull(mt_rand(0, $range->count()));
                    $range = collect($range->values());
                }
                // dd($range, $duration, $range->count());
                for($i = $duration; $i > 0; $i--) {
                    factory(Log::class)->create([
                        'log_by_type' => Faculty::class,
                        'log_by_id' => $course->faculty->id,
                        'course_id' => $course->id,
                        'reader_id' => $course->room->id,
                        'date' => $day->copy(),
                        'created_at' => $day->copy()->setTimeFrom($course->time_from)->addMinutes($range->pull(mt_rand(0, $range->count())))->addSeconds(mt_rand(0, 59)),
                        'remarks' => 'stamp'
                    ]);
                    $range = collect($range->values());
                }
                $course->load('logs')->parsefacultylogsbydate($day);
            }
            $course->students->each(function($student) use($course, $days) {
                $course->students->find($student)->pivot->update(['status' => null]);
                foreach($days as $day) {
                    $log = $day->copy()->setTimeFrom($course->time_from)->subMinutes(5)->addMinutes(rand(0, 15))->addSeconds(rand(0, 59));
                    $remark = rand(1, 100) > 90 ? 'absent' : ($day->copy()->setTimeFrom($course->time_from)->gt($log) ? 'ok' : 'late');
                    factory(Log::class)->create([
                        'log_by_type' => Student::class,
                        'log_by_id' => $student->id,
                        'course_id' => $course->id,
                        'reader_id' => $course->room->id,
                        'date' => $day,
                        'created_at' => $remark == 'absent' ? $day->copy()->setTimeFrom($course->time_end) : $log,
                        'remarks' => $remark
                    ]);
                    $stc = $student->courses->find($course);
                    $abs = $stc->logs()->where('remarks', 'absent')->where('log_by_type', Student::class)->where('log_by_id', $student->id)->count();
                    if($abs >= $course->getdroprate()) {
                        $stc->pivot->update(['status' => 'dropped']);
                    } else if($abs >= $course->getdroprate() * 0.75) {
                        $stc->pivot->update(['status' => 'warning']);
                    }

                    DB::table('ended_classes')->insert([
                        'course_id' => $course->id,
                        'date' => $day
                    ]);
                }
            });
        });
    }
}
