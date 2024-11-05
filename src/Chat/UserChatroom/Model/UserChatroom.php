<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Model;

use Chat\Chatroom\Relation\BelongsToChatroom;
use Chat\User\Relation\BelongsToUser;
use Pandawa\Component\Ddd\AbstractModel;

/**
 * @property string $chatroom_id
 * @property string $user_id
 * @property bool $isAdmin
 * @author frada <fbahezna@gmail.com>
 */
class UserChatroom extends AbstractModel
{
    use BelongsToChatroom, BelongsToUser;
}