<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Event;

use Chat\Message\Model\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Pandawa\Component\Message\AbstractMessage;

/**
 * @author frada <fbahezna@gmail.com>
 */
class JoinUserChatroomEvent extends AbstractMessage implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    private Message $message;

    public function getMessage(): Message
    {
        return $this->message;
    }

    public function broadcastOn(): PresenceChannel
    {
        return new PresenceChannel('chatroom.' . $this->getMessage()->chatroom_id);
    }

    public function broadcastAs(): string
    {
        return sprintf('user [%s] joined', $this->getMessage()->user->name);
    }
}