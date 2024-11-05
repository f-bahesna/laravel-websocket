<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Event;

use BeyondCode\LaravelWebSockets\WebSockets\Channels\PresenceChannel;
use Chat\Message\Model\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
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

    public function broadcastOn()
    {
        $channel = new PresenceChannel('chatroom.' . $this->message->chatroom_id);
        dd(json_encode($channel));
    }
}