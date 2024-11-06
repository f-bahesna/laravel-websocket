<?php
declare(strict_types=1);

namespace Chat\UserChatroom\Exception;

/**
 * @author frada <fbahezna@gmail.com>
 */
class UserNotFoundInRoomException extends \Exception
{
    public function __construct()
    {
        parent::__construct();
        abort(409, 'user not found in room');
    }
}