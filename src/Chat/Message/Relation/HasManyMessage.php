<?php
declare(strict_types=1);

namespace Chat\Message\Relation;

use Chat\Message\Model\Message;
use Pandawa\Component\Ddd\Relationship\HasMany;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
trait HasManyMessage
{
    use RelationshipBehaviorTrait;

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}