<?php
declare(strict_types=1);

namespace Chat\Message\Service;

use Chat\Message\DTO\SendMessageDTO;
use Chat\Message\Model\Message;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class SendMessageService
{
    public function send(SendMessageDTO $DTO): Message
    {
        $message = new Message();
        $message->chatroom_id = $DTO->getChatroom();
        $message->user_id = $DTO->getUser();
        $message->text = $DTO->getText();

        return $message;
    }
}