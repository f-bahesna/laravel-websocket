<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Illuminate\Support\Facades\Broadcast;

/**
 * @
 */
Broadcast::channel('chatroom.{chatroom}', function ($user, $chatroom) {
    if($user->canJoinRoom($chatroom)){
        return ['id' => $user->id, 'name' => $user->name ];
    }

    return null;
});
