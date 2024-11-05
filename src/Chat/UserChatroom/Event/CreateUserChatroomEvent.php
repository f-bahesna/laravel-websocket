<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Event;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Pandawa\Component\Message\AbstractMessage;

/**
 * @author frada <fbahezna@gmail.com>
 */
class CreateUserChatroomEvent extends AbstractMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $chatroom;

    public function getChatroom(): string
    {
        return $this->chatroom;
    }

    public function broadcastOn(): Channel
    {
        return new Channel(
            sprintf('%s', $this->getChatroom())
        );
    }

//        public function broadcastOn()
//        {
//            return ['public'];
//        }
//
//        public function broadcastAs()
//        {
//            return 'chat';
//        }
}