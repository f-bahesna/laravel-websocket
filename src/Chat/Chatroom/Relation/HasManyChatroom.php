<?php
declare(strict_types=1);

namespace Chat\Chatroom\Relation;

use Chat\Chatroom\Model\Chatroom;
use Pandawa\Component\Ddd\Relationship\HasMany;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
trait HasManyChatroom
{
    use RelationshipBehaviorTrait;

    public function chatrooms(): HasMany
    {
        return $this->hasMany(Chatroom::class);
    }
}