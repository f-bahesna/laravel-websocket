<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Relation;

use Chat\UserChatroom\Model\UserChatroom;
use Pandawa\Component\Ddd\Relationship\HasMany;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
trait HasManyUserChatroom
{
    use RelationshipBehaviorTrait;

    public function userChatrooms(): HasMany
    {
        return $this->hasMany(UserChatroom::class);
    }
}