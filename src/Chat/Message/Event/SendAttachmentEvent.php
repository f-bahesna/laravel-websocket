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
class SendAttachmentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    private string $chatroom;

    private string $username;

    private string $attachment;

    /**
     * @param string $chatroom
     * @param string $username
     * @param string $attachment
     */
    public function __construct(string $chatroom, string $username, string $attachment)
    {
        $this->chatroom = $chatroom;
        $this->username = $username;
        $this->attachment = $attachment;
    }

    public function broadcastOn()
    {
        return new PresenceChannel(
            sprintf('chatroom.%s', $this->chatroom)
        );
    }

    public function broadcastAs()
    {
        return sprintf('user [%s] send an attachment in [%s].', $this->username, $this->attachment);
    }
}