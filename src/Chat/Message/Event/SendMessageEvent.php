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

    public $message,$chatroom,$username;

    /**
     * @param $message
     * @param $chatroom
     * @param $username
     */
    public function __construct($message, $chatroom, $username)
    {
        $this->message = $message;
        $this->chatroom = $chatroom;
        $this->username = $username;
    }

    public function broadcastOn()
    {
        return new PresenceChannel(
            sprintf('chatroom.%s', $this->chatroom)
        );
    }

    public function broadcastAs()
    {
        return sprintf('user [%s] send message.', $this->username);
    }
}