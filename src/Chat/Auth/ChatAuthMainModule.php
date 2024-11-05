<?php
declare(strict_types=1);

namespace Chat\Auth;

use Chat\Auth\Guard\ChatUserGuard;
use Illuminate\Support\Facades\Auth;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class ChatAuthMainModule extends AbstractModule
{
    protected function build(): void
    {
        Auth::extend('user', function ($app, $name, array $config){
            return new ChatUserGuard(
                $app['request'],
                Auth::createUserProvider($config['provider'])
            );
        });
    }
}

