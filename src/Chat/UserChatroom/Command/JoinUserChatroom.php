<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Command;

use Pandawa\Component\Message\AbstractMessage;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class JoinUserChatroom extends AbstractMessage implements NameableMessageInterface
{
    use NameableClassTrait;

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