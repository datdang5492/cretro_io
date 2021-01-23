<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AttendeeLeftEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $attendee;

    public $meetingId;

    /**
     * Create a new event instance.
     *
     * @param $attendee
     * @param $meetingId
     */
    public function __construct($attendee, $meetingId)
    {
        $this->attendee = $attendee;
        $this->meetingId = $meetingId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['retrospective-channel' . $this->meetingId];
    }

    public function broadcastAs()
    {
        return 'attendee-left' . $this->meetingId;
    }
}
