<?php

namespace App\Http\Resources;

use App\Faculty;
use Illuminate\Http\Resources\Json\JsonResource;

class FacultyStats extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'labels' => $this->labels(),
            'datasets' => [
                [
                    'label' => 'Average Login Time (in minutes)',
                    'backgroundColor' => '#ffde4a',
                    'data' => $this->averagetime(),
                ],
            ]
        ];
    }

    private function labels()
    {
        $labels = [];
        while($x = @$this[@$i++ ?? 0]) {
            $labels[] = $x->shortname;
        }
        return $labels;
    }

    private function averagetime()
    {
        $time = [];
        while($x = @$this[@$i++ ?? 0]) {
            $time[] =
            round(
                $x->faculties->filter(function($faculty) {
                    return $faculty->ongoingcourses()->count() > 0;
                })->avg(function($faculty) {
                    return $faculty->ongoingcourses()->avg(function($course) {
                        return $course->logs()->where('log_by_type', Faculty::class)->whereIn('remarks', ['ok', 'late'])->get()->avg(function($log) use($course) {
                            return today()->setTimeFrom($course->time_from)->diffInSeconds(today()->setTimeFrom($log->info['first']), false);
                        });
                    });
                }) / 60
            , 3);
        }
        // dd($time);
        return $time;
    }

}
