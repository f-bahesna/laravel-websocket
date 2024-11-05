<?php
declare(strict_types=1);

namespace Chat\Chatroom;

use Pandawa\Component\Module\AbstractModule;
use Pandawa\Component\Module\Provider\EventProviderTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class ChatChatroomMainModule extends AbstractModule
{
    use EventProviderTrait;

    protected function listens(): array
    {
        return [

        ];
    }
}