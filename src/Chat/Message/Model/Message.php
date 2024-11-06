<?php
declare(strict_types=1);

namespace Chat\Message\Model;

use Chat\Chatroom\Relation\BelongsToChatroom;
use Chat\Chatroom\Relation\HasManyChatroom;
use Chat\User\Relation\BelongsToUser;
use Chat\User\Relation\HasManyUsers;
use Pandawa\Component\Ddd\AbstractModel;

/**
 * @property string $chatroom_id
 * @property string $user_id
 * @property string $text
 * @property string $attachment
 * @author frada <fbahezna@gmail.com>
 */
class Message extends AbstractModel
{
    use BelongsToChatroom, BelongsToUser;
}