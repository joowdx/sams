<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacultiesForCalendarResource extends JsonResource
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
            'ok' => $this->logs->filter(function($log) { return $log->remarks == 'ok'; })->count() ?: '0',
            'late' => $this->logs->filter(function($log) { return $log->remarks == 'late'; })->count() ?: '0',
            'excuse' => $this->logs->filter(function($log) { return $log->remarks == 'excuse'; })->count() ?: '0',
            'leave' => $this->logs->filter(function($log) { return $log->remarks == 'leave'; })->count() ?: '0',
            'absent' => $this->logs->filter(function($log) { return $log->remarks == 'absent'; })->count() ?: '0',
        ];
    }
}
