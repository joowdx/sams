<?php

namespace App\Events;

use App\AcademicPeriod;
use App\Course;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RefreshMap
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $courses;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {


        Course::where(function($query) {
            // $query->
        });

        $this->courses = null;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('map');
    }
}
