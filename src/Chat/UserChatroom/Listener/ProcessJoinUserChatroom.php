<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Listener;

use BeyondCode\LaravelWebSockets\WebSockets\Channels\PresenceChannel;
use Chat\Message\Model\Message;
use Chat\UserChatroom\Event\JoinUserChatroomEvent;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class ProcessJoinUserChatroom implements ShouldBroadcast
{
    use InteractsWithSockets;

    private Message $message;

    /**
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function handle(JoinUserChatroomEvent $event): PresenceChannel
    {
        return $this->broadcastOn();
    }

    public function broadcastOn(): PresenceChannel
    {
        return new PresenceChannel('chatroom.' . $this->message->chatroom_id);
    }
}