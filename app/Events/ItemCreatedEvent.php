<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ItemCreatedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item;

    public $meetingId;

    /**
     * Create a new event instance.
     *
     * @param $item
     * @param $meetingId
     */
    public function __construct($item, $meetingId)
    {
        $this->item = $item;
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
        return 'new-item' . $this->meetingId;
    }
}
