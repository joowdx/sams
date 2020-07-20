<?php

namespace App\Http\Resources;

use App\Student;
use Illuminate\Http\Resources\Json\JsonResource;

class ChartStatistics extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'labels' => $this->labels(),
            'datasets' => [
                [
                    'label' => 'Drops',
                    'backgroundColor' => '#8e5ea2',
                    'data' => $this->drops(),
                ],
                [
                    'label' => 'Lates',
                    'backgroundColor' => '#f39c12',
                    'data' => $this->remarks('late'),
                ],
                [
                    'label' => 'Absences',
                    'backgroundColor' => '#c45850',
                    'data' => $this->remarks('absent'),
                ],
            ],
        ];
    }

    private function remarks($remark)
    {
        $lates = [];
        while($x = @$this[@$i++ ?? 0]) {
            $lates[] = $x->students->load([
                'courses' => function($query) use($x) {
                    $query->whereIn('id', $x->students->flatMap(function($student) {
                            return $student->courses->map(function($course) {
                                return $course->id;
                            });
                        })->unique()
                    );
                },
                'courses.logs' => function($query) use($x, $remark) {
                    $query->where('remarks', $remark)
                          ->where('log_by_type', Student::class)
                          ->whereIn('log_by_id', $x->students->pluck('id'));
                },
            ])->flatMap(function($student) {
                return $student->courses;
            })->unique('id')->flatMap(function($course) {
                return $course->logs;
            })->count();
        }
        return $lates;
    }

    private function labels()
    {
        $labels = [];
        while($x = @$this[@$i++ ?? 0]) {
            $labels[] = $x->shortname;
        }
        return $labels;
    }

    private function drops()
    {
        $drops = [];
        while($x = @$this[@$i++ ?? 0]) {
            // $drops[] = $x->students->load([
            //     'courses' => function($query) use($x) {
            //         $query->whereIn('id', $x->students->flatMap(function($student) {
            //                 return $student->courses->map(function($course) {
            //                     return $course->id;
            //                 });
            //             })->unique()
            //         );
            //     },
            //     'courses.logs' => function($query) use($x) {
            //         $query->where('remarks', 'absent')
            //               ->where('log_by_type', Student::class)
            //               ->whereIn('log_by_id', $x->students->pluck('id'));
            //     },
            // ])->reduce(function($count, $student) {
            //     return $count + $student->courses->filter(function($course) use($student) {
            //         return $course->logs->filter(function($log) use($student) {
            //             return $log->remarks == 'absent' && $log->log_by_id == $student->id;
            //         })->count() > $course->getdroprate();
            //     })->count();
            // });
            $drops[] = $x->students->reduce(function($count, $student) {
                return $count + $student->courses->filter(function($course) {
                    return $course->pivot->status == 'dropped';
                })->count();
            });
        }
        return $drops;
    }

    private function courses()
    {
        $courses = [];
        while($x = @$this[@$i++ ?? 0]) {
            $courses[] = ceil($x->students->count() ? $x->students->reduce(function($count, $student) {
                return $count + $student->courses->count();
            }) / $x->students->count() : 0);
        }
        return $courses;
    }

    private function students()
    {
        $students = [];
        while($x = @$this[@$i++ ?? 0]) {
            $students[] = $x->students->count();
        }
        return $students;
    }
}
