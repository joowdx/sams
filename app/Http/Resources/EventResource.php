<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'start' => $this->start->format('Y-m-d'),
            'end' => $this->end->addDay()->format('Y-m-d'),
            'remarks' => $this->remarks,
            'color' => $this->color(),
            'textColor' => '#ECF0F1',
            'allDay' => true,
        ];
    }

    private function color()
    {
        switch ($this->remarks) {
            case 'national holiday': return '#F44336';
            case 'local holiday': return '#FFB74D';
            case 'institutional event': return '#1976D2';
            case 'class suspension': return '#9C27B0';
            case 'break': return '#FFC107';
            case 'info': return '#4DD0E1';
            default: return '#0000';
        }
    }
}
