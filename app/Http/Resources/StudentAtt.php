<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentAtt extends JsonResource
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
            'courses' => StudentCourse::collection($this->courses),
            'logs' => StudentCourseLog::collection($this->courses->flatMap(function ($c) { return $c->logs; })),
        ];
    }
}
