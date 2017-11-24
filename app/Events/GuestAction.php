<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Guest;

class GuestAction
{
    private $guest;
    private $action;

    use InteractsWithSockets, SerializesModels;

    public function getGuest()
    {
        return $this->guest;
    }
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Create a new event instance.
     * ClientAction constructor.
     * @param Client $client
     * @param $action
     */
    public function __construct(Guest $guest, $action)
    {
        $this->guest = $guest;
        $this->action = $action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
