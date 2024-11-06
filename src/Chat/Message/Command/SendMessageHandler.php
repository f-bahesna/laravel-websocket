<?php
declare(strict_types=1);

namespace Chat\Message\Command;

use Chat\Chatroom\Finder\ChatroomFinder;
use Chat\Message\DTO\SendMessageDTO;
use Chat\Message\Event\SendMessageEvent;
use Chat\Message\Repository\MessageRepository;
use Chat\Message\Service\SendMessageService;
use Chat\UserChatroom\Exception\UserNotFoundInRoomException;
use Chat\UserChatroom\Finder\UserChatroomFinder;
use Chat\UserChatroom\Model\UserChatroom;
use Psr\Log\InvalidArgumentException;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class SendMessageHandler
{
    public function __construct(
        private SendMessageService $service,
        private ChatroomFinder $chatroomFinder,
        private UserChatroomFinder $userChatroomFinder,
        private MessageRepository  $messageRepository
    )
    {
    }

    public function handle(SendMessage $message)
    {
      $this->isUserExistsInChatroom($message->getUser());

      $userChatroom = $this->userChatroomFinder->findOneByChatroom($message->getChatroom());

      $messageService = $this->service->send(
            new SendMessageDTO(
                [
                    'chatroom' => $userChatroom->chatroom_id,
                    'user' => $message->getUser(),
                    'text' => $message->getText()
                ]
            )
        );

      $this->messageRepository->save($messageService);

      broadcast(
          new SendMessageEvent(
              $message->getText(),
              $userChatroom->chatroom_id,
              $message->getUser(),
        )
      );

      return $messageService;
    }

    /**
     * @throws UserNotFoundInRoomException
     */
    private function isUserExistsInChatroom(string $user): void
    {
        if(null == $this->userChatroomFinder->findOneByUser($user)){
            throw new UserNotFoundInRoomException();
        }
    }
}