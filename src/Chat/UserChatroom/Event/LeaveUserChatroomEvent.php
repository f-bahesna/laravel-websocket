<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Event;

use Chat\UserChatroom\Model\UserChatroom;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Pandawa\Component\Message\AbstractMessage;

/**
 * @author frada <fbahezna@gmail.com>
 */
class LeaveUserChatroomEvent extends AbstractMessage implements ShouldBroadcast
{
    private UserChatroom $chatroom;

    public function getChatroom(): UserChatroom
    {
        return $this->chatroom;
    }

    public function broadcastOn(): PresenceChannel
    {
        return new PresenceChannel(
            sprintf('chatroom.%s', $this->getChatroom()->chatroom_id)
        );
    }

    public function broadcastAs(): string
    {
        return sprintf('user [%s] leave', $this->getChatroom()->user->name);
    }
}