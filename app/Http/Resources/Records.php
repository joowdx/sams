<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Records extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $record = [
            'id' => $this->id,
            explode('\\', strtolower($this->log_by_type))[1] => [
                'id' => $this->log_by->id,
                'name' => $this->log_by->name,
            ],
            'course' => $this->course ? [
                'id' => $this->course->id,
                'code' => $this->course->code,
                'title' => $this->course->title,
                'description' => $this->course->description,
            ] : null,
            'from' => $this->from_by->name ?? null,
            'time' => $this->created_at->format('Y-m-d H:i:s'),
            'remarks' => $this->remarks,
        ];
        !$this->from_by ?? (get_class($this->from_by) == 'App\Room' ? null : ($record['type'] = $this->from_by->type));
        return $record;
    }
}
