<?php
declare(strict_types=1);

namespace Chat\Message\Command;

use Chat\Message\DTO\SendAttachmentDTO;
use Chat\Message\Event\SendAttachmentEvent;
use Chat\Message\Repository\MessageRepository;
use Chat\Message\Service\SendAttachmentService;
use Chat\User\Finder\UserFinder;
use Chat\UserChatroom\Exception\UserNotFoundInRoomException;
use Chat\UserChatroom\Finder\UserChatroomFinder;
use Illuminate\Support\Facades\Storage;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class SendAttachmentHandler
{
    public function __construct(
        private SendAttachmentService $service,
        private UserChatroomFinder $userChatroomFinder,
        private MessageRepository  $messageRepository,
        private UserFinder $userFinder
    )
    {
    }

    public function handle(SendAttachment $message)
    {
        $this->isUserExistsInChatroom($message->getUser());

        $userChatroom = $this->userChatroomFinder->findOneByChatroom($message->getChatroom());

        $user = $this->userFinder->findOrFail($message->getUser());

        $typeLocation = str_starts_with($message->getAttachment()->getMimeType(), 'image/') ? 'picture' : 'video';

        $filePath = sprintf('root/%s/%s', $typeLocation, str_replace(' ', '-', strtolower($message->getAttachment()->getClientOriginalName())));

        Storage::disk('local')->put($filePath, $message->getAttachment()->getContent());

        $messageService = $this->service->send(
            new SendAttachmentDTO(
                [
                    'chatroom' => $userChatroom->chatroom_id,
                    'user' => $message->getUser(),
                    'filepath' => $filePath
                ]
            )
        );

        $this->messageRepository->save($messageService);

        broadcast(
            new SendAttachmentEvent(
                $userChatroom->chatroom_id,
                $user->name,
                $filePath
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