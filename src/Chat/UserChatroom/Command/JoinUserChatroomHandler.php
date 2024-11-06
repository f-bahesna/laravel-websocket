<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Command;

use Chat\Chatroom\Finder\ChatroomFinder;
use Chat\Message\Model\Message;
use Chat\Message\Repository\MessageRepository;
use Chat\User\Finder\UserFinder;
use Chat\UserChatroom\Event\JoinUserChatroomEvent;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class JoinUserChatroomHandler
{
    public function __construct(
        private ChatroomFinder $chatroomFinder,
        private UserFinder $userFinder,
        private MessageRepository $messageRepository
    )
    {
    }

    public function handle(JoinUserChatroom $message): Message
    {
        $chatroomFinder = $this->chatroomFinder->findOrFail($message->getChatroom());
        $userFinder = $this->userFinder->findOrFail($message->getUser());

        $messageModel = new Message();
        $messageModel->chatroom()->associate($chatroomFinder);
        $messageModel->user()->associate($userFinder);
        $messageModel->text = $message->getText();

        $this->messageRepository->save($messageModel);

        broadcast(
            new JoinUserChatroomEvent(
                [
                    "message" => $messageModel
                ]
            )
        )->toOthers();

        return $messageModel;
    }
}