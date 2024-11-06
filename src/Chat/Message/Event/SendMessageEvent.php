<?php
declare(strict_types=1);

namespace Chat\Message\Event;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

/**
 * @author frada <fbahezna@gmail.com>
 */
class SendMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $message,$chatroom,$user;

    /**
     * @param $message
     * @param $chatroom
     * @param $user
     */
    public function __construct($message, $chatroom, $user)
    {
        $this->message = $message;
        $this->chatroom = $chatroom;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return new PresenceChannel(
            sprintf('chatroom.%s', $this->chatroom)
        );
    }
}