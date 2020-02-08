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
        $students = StudentsForCalendarResource::collection($this->students);
        $faculty = new FacultiesForCalendarResource($this->faculty);
        $entities = [$faculty];
        $entities = array_merge($entities, $students->all());
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
            'students' => StudentResource::collection($this->students),
            'entities' => collect($entities),
            'logs' => LogsForCalendarResource::collection($this->logs),
        ];
    }
}
