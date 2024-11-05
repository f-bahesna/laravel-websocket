<?php
declare(strict_types=1);

namespace Chat\User\Relation;

use Chat\User\Model\User;
use Pandawa\Component\Ddd\Relationship\HasMany;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
trait HasManyUsers
{
    use RelationshipBehaviorTrait;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}