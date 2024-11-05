<?php
declare(strict_types=1);

namespace Chat\User\Relation;

use Chat\User\Model\User;
use Pandawa\Component\Ddd\Relationship\BelongsTo;

/**
 * @author frada <fbahezna@gmail.com>
 */
trait BelongsToUser
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}