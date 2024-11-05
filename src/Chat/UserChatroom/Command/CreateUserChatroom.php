<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Command;

use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class CreateUserChatroom extends AbstractCommand implements NameableMessageInterface
{
    use NameableClassTrait;

    private string $title;
    private int $max;

    private string $user;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function getUser(): string
    {
        return $this->user;
    }
}