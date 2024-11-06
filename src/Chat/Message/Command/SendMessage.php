<?php
declare(strict_types=1);

namespace Chat\Message\Command;

use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class SendMessage extends AbstractCommand implements NameableMessageInterface
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