<?php
declare(strict_types=1);

namespace Chat\UserChatroom;

use Chat\UserChatroom\Event\JoinUserChatroomEvent;
use Chat\UserChatroom\Listener\ProcessJoinUserChatroom;
use Pandawa\Component\Module\AbstractModule;
use Pandawa\Component\Module\Provider\EventProviderTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
class ChatUserChatroomMainModule extends AbstractModule
{
    use EventProviderTrait;

    protected function listens(): array
    {
        return [
            JoinUserChatroomEvent::class => [
            ]
        ];
    }
}