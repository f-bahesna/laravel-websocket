<?php
declare(strict_types=1);

namespace Chat\User\Finder;

use Chat\User\Model\User;
use Pandawa\Component\Ddd\Finder\AbstractModelFinder;

/**
 * @author frada <fbahezna@gmail.com>
 */
class UserFinder extends AbstractModelFinder
{
    protected function getModelClass(): string
    {
        return User::class;
    }

    public function findByPhone(string $phone): User|null
    {
        if(null !== $user = $this->repo()->findOneBy(["phone" => $phone])){
            return $user;
        }

        return null;
    }
}