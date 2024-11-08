<?php
declare(strict_types=1);

namespace Chat\Message\Repository;

use Pandawa\Component\Ddd\Repository\Repository;

/**
 * @author frada <fbahezna@gmail.com>
 */
class MessageRepository extends Repository
{
    public function findAllMessageByChatroom(string $chatroom)
    {
        $qb = $this->createQueryBuilder();

        $qb->where('chatroom_id', $chatroom);

        return $this->execute($qb);
    }
}