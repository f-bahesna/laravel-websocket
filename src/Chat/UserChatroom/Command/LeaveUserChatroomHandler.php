<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Command;

use Chat\UserChatroom\Event\LeaveUserChatroomEvent;
use Chat\UserChatroom\Finder\UserChatroomFinder;
use Chat\UserChatroom\Model\UserChatroom;
use Chat\UserChatroom\Repository\UserChatroomRepository;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class LeaveUserChatroomHandler
{
    public function __construct(
        private UserChatroomFinder $userChatroomFinder,
        private UserChatroomRepository $userChatroomRepository
    )
    {
    }

    public function handle(LeaveUserChatroom $message): UserChatroom
    {
        $userChatroom = $this->findUserChatroomByUser($message->getUser(), $message->getChatroom());

        broadcast(
            new LeaveUserChatroomEvent(
                [
                    'chatroom' => $userChatroom
                ]
            )
        );

        $this->userChatroomRepository->remove($userChatroom);

        return $userChatroom;
    }

    private function findUserChatroomByUser(string $user, string $chatroom): UserChatroom|null
    {
        if(null === $userChatroom = $this->userChatroomFinder->findOneByChatroomAndUser($user, $chatroom)){
            abort(409, "user does not exists");
        }

        return $userChatroom;
    }


}