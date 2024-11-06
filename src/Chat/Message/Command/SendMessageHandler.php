<?php
declare(strict_types=1);

namespace Chat\Message\Command;

use Chat\Chatroom\Finder\ChatroomFinder;
use Chat\Message\DTO\SendMessageDTO;
use Chat\Message\Event\SendMessageEvent;
use Chat\Message\Repository\MessageRepository;
use Chat\Message\Service\SendMessageService;
use Chat\User\Finder\UserFinder;
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
        private UserChatroomFinder $userChatroomFinder,
        private MessageRepository  $messageRepository,
        private UserFinder $userFinder
    )
    {
    }

    public function handle(SendMessage $message)
    {
      $this->isUserExistsInChatroom($message->getUser());

      $userChatroom = $this->userChatroomFinder->findOneByChatroom($message->getChatroom());

        $user = $this->userFinder->findOrFail($message->getUser());

        $messageService = $this->service->send(
            new SendMessageDTO(
                [
                    'chatroom' => $userChatroom->chatroom_id,
                    'user' => $user->name,
                    'text' => $message->getText()
                ]
            )
        );

      $this->messageRepository->save($messageService);

      broadcast(
          new SendMessageEvent(
              $message->getText(),
              $userChatroom->chatroom_id,
              $user->name,
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