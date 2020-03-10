<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentCourseLog extends JsonResource
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
            'id' => $this->id,
            'resourceId' => $this->course->id,
            'start' => $this->date->format('Y-m-d'),
            'color' => '#0000',
            'textColor' => $this->color(),
            'icon' => $this->icon(),
            'title' => $this->title(),
            'remarks' => $this->remarks != 'ok' ? $this->remarks : 'present',
        ];
    }

    private function color()
    {
        switch ($this->remarks) {
            case 'ok': return '#4CAF50';
            case 'late': return '#F57F17';
            case 'absent': return '#f44336';
            case 'excuse': return '#03A9F4';
            case 'leave': return '#E91E63';
            default: return '#0000';
        }
    }

    private function icon()
    {
        switch ($this->remarks) {
            case 'ok': return 'check-circle';
            case 'late': return 'dot-circle';
            case 'absent': return 'times-circle';
            case 'excuse': return 'scrubber';
            case 'leave': return 'minus-circle';
            default: return '#000';
        }
    }

    private function title()
    {
        switch ($this->remarks) {
            case 'absent': return 'absent';
            case 'excuse': return 'excuse';
            case 'leave': return 'leave';
            default: return $this->created_at ? $this->created_at->format('H:i:s') : null;
        }
    }
}
