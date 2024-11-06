<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Service;

use Chat\Chatroom\Finder\ChatroomFinder;
use Chat\Chatroom\Model\Chatroom;
use Chat\User\Finder\UserFinder;
use Chat\UserChatroom\Command\CreateUserChatroom;
use Chat\UserChatroom\Model\UserChatroom;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class UserChatroomService
{
    public function __construct(
        private ChatroomFinder $chatRoomFinder,
        private UserFinder     $userFinder
    )
    {
    }

    public function create(UserChatroom $userChatroom, CreateUserChatroom $message, Chatroom $chatroom): UserChatroom
    {
        $chatroom = $this->chatRoomFinder->findOrFail($chatroom->getId());
        $user = $this->userFinder->findOrFail($message->getUser());

        $userChatroom->chatroom()->associate($chatroom);
        $userChatroom->user()->associate($user);

        return $userChatroom;
    }
}