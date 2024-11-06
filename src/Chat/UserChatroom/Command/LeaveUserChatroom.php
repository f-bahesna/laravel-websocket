<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Command;

use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class LeaveUserChatroom extends AbstractCommand implements NameableMessageInterface
{
    use NameableClassTrait;

    private string $user;
    private string $chatroom;

    public function getUser(): string
    {
        return $this->user;
    }

    public function getChatroom(): string
    {
        return $this->chatroom;
    }
}