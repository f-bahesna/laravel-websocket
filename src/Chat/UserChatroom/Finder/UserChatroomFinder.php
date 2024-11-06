<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Finder;

use Chat\UserChatroom\Model\UserChatroom;
use Pandawa\Component\Ddd\Finder\AbstractModelFinder;

/**
 * @author frada <fbahezna@gmail.com>
 */
class UserChatroomFinder extends AbstractModelFinder
{
    protected function getModelClass(): string
    {
        return UserChatroom::class;
    }

    public function findOneByUser(string $user): UserChatroom|null
    {
        if(null !== $userChatroom = $this->repo()->findOneBy(['user_id' => $user])){
            return $userChatroom;
        }

        return null;
    }

    public function findOneByChatroomAndUser(string $user, string $chatroom)
    {
        if(null !== $userChatroom = $this->repo()->findOneBy(['user_id' => $user, 'chatroom_id' => $chatroom])){
            return $userChatroom;
        }

        return null;
    }

    public function findOneByChatroom(string $chatroom): UserChatroom|null
    {
        if(null !== $userChatroom = $this->repo()->findOneBy(['chatroom_id' => $chatroom])){
            return $userChatroom;
        }

        return null;
    }

    public function countUserChatroom(string $chatroom): int
    {
        return $this->repo()->findBy(['chatroom_id' => $chatroom])->count();
    }
}