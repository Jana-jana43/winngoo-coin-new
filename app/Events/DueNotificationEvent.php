<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DueNotificationEvent implements ShouldBroadcast
{
    public $message;
    public $userId;

    public function __construct($message, $userId)
    {
        $this->message = $message;
        $this->userId = $userId;
    }

    public function broadcastOn()
    {
        return new Channel('user-'.$this->userId);
    }

    public function broadcastAs()
    {
        return 'due-notification';
    }
}