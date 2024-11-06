<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Command;

use Chat\Chatroom\Finder\ChatroomFinder;
use Chat\Chatroom\Model\Chatroom;
use Chat\Chatroom\Repository\ChatroomRepository;
use Chat\Chatroom\Service\ChatroomServices;
use Chat\UserChatroom\Event\CreateUserChatroomEvent;
use Chat\UserChatroom\Model\UserChatroom;
use Chat\UserChatroom\Repository\UserChatroomRepository;
use Chat\UserChatroom\Service\UserChatroomService;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class CreateUserChatroomHandler
{
    public function __construct(
        private ChatroomServices    $chatroomServices,
        private UserChatroomService $userChatroomService,
        private ChatroomRepository  $chatRoomRepository,
        private UserChatroomRepository $userChatroomRepository,
        private ChatroomFinder $chatroomFinder
    )
    {
    }

    public function handle(CreateUserChatroom $message): UserChatroom
    {
        $this->validateDuplicateChatroom($message->getTitle());

        //create chatroom first
        $chatroom = new Chatroom();
        $chatRoomService = $this->chatroomServices->create($chatroom, $message);

        $this->chatRoomRepository->save($chatRoomService);

        //then create user chatroom
        $userChatroom = new UserChatroom();
        $userChatroomService = $this->userChatroomService->create($userChatroom, $message, $chatRoomService);

        $this->userChatroomRepository->save($userChatroomService);

        broadcast(
            new CreateUserChatroomEvent(
                [
                    'chatroom' => $chatroom->getId()
                ]
            )
        )->toOthers();

        return $userChatroom;
    }

    private function validateDuplicateChatroom(string $name):void
    {
        if (null !== $this->chatroomFinder->findByTitle($name)) {
            abort(409, "chatroom already exists");
        }
    }
}