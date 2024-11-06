<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Command;

use Chat\Chatroom\Finder\ChatroomFinder;
use Chat\User\Finder\UserFinder;
use Chat\UserChatroom\Event\JoinUserChatroomEvent;
use Chat\UserChatroom\Finder\UserChatroomFinder;
use Chat\UserChatroom\Model\UserChatroom;
use Chat\UserChatroom\Repository\UserChatroomRepository;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class JoinUserChatroomHandler
{
    public function __construct(
        private ChatroomFinder $chatroomFinder,
        private UserFinder $userFinder,
        private UserChatroomFinder $userChatroomFinder,
        private UserChatroomRepository $userChatroomRepository
    )
    {
    }

    public function handle(JoinUserChatroom $message): UserChatroom
    {
        $chatroomFinder = $this->chatroomFinder->findOrFail($message->getChatroom());

        //validate max chatroom
        $this->assertValidateChatroomMaximum($message->getChatroom(), $chatroomFinder->max);

        $userFinder = $this->userFinder->findOrFail($message->getUser());

        $userChatroom = $this->userChatroomFinder->findOneByChatroom($chatroomFinder->getId());
        $userChatroom->chatroom()->associate($chatroomFinder);
        $userChatroom->user()->associate($userFinder);

        $this->userChatroomRepository->save($userChatroom);

        broadcast(
            new JoinUserChatroomEvent(
                [
                    "message" => $userChatroom
                ]
            )
        )->toOthers();

        return $userChatroom;
    }

    private function assertValidateChatroomMaximum(string $chatroom, int $max): void
    {
        if($this->userChatroomFinder->countUserChatroom($chatroom) > $max){
            abort(409, "This chatroom is already at maximum capacity.");
        }
    }
}