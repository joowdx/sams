<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'schoolid' => $this->schoolid,
            'uid' => $this->uid,
            'name' => $this->name,
            'department' => [
                'shortname' => $this->department->shortname,
                'name' => $this->department->name,
            ],
        ];
    }
}
