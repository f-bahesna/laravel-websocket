<?php
declare(strict_types=1);

namespace Chat\User;

use Chat\Auth\Guard\ChatUserGuard;
use Illuminate\Support\Facades\Auth;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class ChatUserMainModule extends AbstractModule
{
    protected function build(): void
    {
        Auth::extend('user', function ($app, $name, array $config){
           return new ChatUserGuard(
               Auth::createUserProvider($config['provider'])
           );
        });
    }
}