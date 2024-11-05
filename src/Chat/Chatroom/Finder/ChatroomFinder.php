<?php
declare(strict_types=1);

namespace Chat\Chatroom\Finder;

use Chat\Chatroom\Model\Chatroom;
use Pandawa\Component\Ddd\Finder\AbstractModelFinder;

/**
 * @author frada <fbahezna@gmail.com>
 */
class ChatroomFinder extends AbstractModelFinder
{
    protected function getModelClass(): string
    {
        return Chatroom::class;
    }

    public function findByTitle(string $title): Chatroom|null
    {
        if(null !== $chatroom = $this->repo()->findOneBy(['title' => $title])){
            return $chatroom;
        }

        return null;
    }
}