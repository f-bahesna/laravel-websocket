<?php

return [
    Acme\Api\AcmeApiModule::class,
    Acme\Web\AcmeWebModule::class,

    Chat\Auth\ChatAuthMainModule::class,
    Chat\User\ChatUserMainModule::class,
    Chat\Chatroom\ChatChatroomMainModule::class,
    Chat\Message\ChatMessageMainModule::class,
    Chat\UserChatroom\ChatUserChatroomMainModule::class,
];
