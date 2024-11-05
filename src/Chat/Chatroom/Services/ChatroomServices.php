<?php
declare(strict_types=1);

namespace Chat\Chatroom\Services;

use Chat\Chatroom\Model\Chatroom;
use Chat\UserChatroom\Command\CreateUserChatroom;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class ChatroomServices
{
    public function create(Chatroom $chatroom, CreateUserChatroom $message): Chatroom
    {
        $chatroom->title = $message->getTitle();
        $chatroom->max = $message->getMax();

        return $chatroom;
    }
}