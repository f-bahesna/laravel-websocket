<?php
declare(strict_types=1);

namespace Chat\Chatroom\Relation;

use Chat\Chatroom\Model\Chatroom;
use Pandawa\Component\Ddd\Relationship\BelongsTo;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
trait BelongsToChatroom
{
    use RelationshipBehaviorTrait;

    public function chatroom(): BelongsTo
    {
        return $this->belongsTo(Chatroom::class);
    }
}