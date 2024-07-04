<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExpenseCreatedOrModified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $expense;
    public $isDeleted;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($expense, $isDeleted = false)
    {
        $this->expense = $expense;
        $this->isDeleted = $isDeleted;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
