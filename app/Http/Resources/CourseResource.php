<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'code' => $this->code,
            'title' => $this->title,
            'description' => $this->description,
            'day' => "$this->day_from - $this->day_to",
            'time' => "$this->time_from - $this->time_to",
            'units' => $this->units,
            'faculty' => [
                'schoolid' => $this->faculty->schoolid,
                'name' => $this->faculty->name,
            ],
            'students' => StudentsForCalendarResource::collection($this->students),
            'logs' => LogsForCalendarResource::collection($this->logs),
        ];
    }
}
