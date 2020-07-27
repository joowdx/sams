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

class RefreshMap implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $courses;
    public $inpremises;
    public $checkedin;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    # public $queue = 'default';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($courses, $inpremises, $checkedin)
    {
        $this->courses = $courses;
        $this->inpremises = $inpremises;
        $this->checkedin = $checkedin;
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

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'courses' => $this->courses,
            'inpremises' => $this->inpremises,
            'checkedin' => $this->checkedin,
        ];
    }
}
