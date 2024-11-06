<?php
declare(strict_types=1);

namespace Chat\Message\DTO;

use Pandawa\Component\Message\AbstractMessage;

/**
 * @author frada <fbahezna@gmail.com>
 */
class SendMessageDTO extends AbstractMessage
{
    private string $chatroom;

    private string $user;

    private string $text;

    public function getChatroom(): string
    {
        return $this->chatroom;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getText(): string
    {
        return $this->text;
    }
}