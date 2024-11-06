<?php
declare(strict_types=1);

namespace Chat\Message\Service;

use Chat\Message\DTO\SendAttachmentDTO;
use Chat\Message\Model\Message;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class SendAttachmentService
{
    public function send(SendAttachmentDTO $DTO): Message
    {
        $message = new Message();
        $message->chatroom_id = $DTO->getChatroom();
        $message->user_id = $DTO->getUser();
        $message->attachment = $DTO->getFilePath();

        return $message;
    }
}