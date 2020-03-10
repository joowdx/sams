<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\FacultyCourseAttendanceForCalendar as FCAFC;
use App\Http\Resources\FacultyCourseLogAttendanceForCalendar as FCLAFC;

class FacultyAttendanceForCalendar extends JsonResource
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
            'id' => "$$this->id",
            'title' => $this->name,
            'children' => $cc = FCAFC::collection($this->courses),
            'logs' => FCLAFC::collection($this->logs->filter(function($l){ return $l->course; })),
            'ok' => $this->logs->filter(function($log) { return $log->remarks == 'ok'; })->count() ?: "0",
            'late' => $this->logs->filter(function($log) { return $log->remarks == 'late'; })->count() ?: "0",
            'excuse' => $this->logs->filter(function($log) { return $log->remarks == 'excuse'; })->count() ?: "0",
            'leave' => $this->logs->filter(function($log) { return $log->remarks == 'leave'; })->count() ?: "0",
            'absent' => $this->logs->filter(function($log) { return $log->remarks == 'absent'; })->count() ?: "0",
        ];
    }
}
