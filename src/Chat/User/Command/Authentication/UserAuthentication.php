<?php
declare(strict_types=1);

namespace Chat\User\Command\Authentication;

use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class UserAuthentication extends AbstractCommand implements NameableMessageInterface
{
    use NameableClassTrait;

    private string $phone;

    public function getPhone(): string
    {
        return $this->phone;
    }
}