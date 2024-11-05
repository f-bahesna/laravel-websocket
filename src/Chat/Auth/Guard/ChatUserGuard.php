<?php
declare(strict_types=1);

namespace Chat\Auth\Guard;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Lcobucci\JWT\Configuration;

/**
 * @author frada <fbahezna@gmail.com>
 */
class ChatUserGuard implements Guard
{

    public function __construct(
        protected Request $request,
        protected UserProvider $provider
    )
    {
    }

    public function check()
    {
        return $this->user();
    }

    public function guest()
    {
        // TODO: Implement guest() method.
    }

    public function id()
    {
        // TODO: Implement id() method.
    }

    public function validate(array $credentials = [])
    {
        // TODO: Implement validate() method.
    }

    public function hasUser()
    {
        // TODO: Implement hasUser() method.
    }

    public function setUser(Authenticatable $user)
    {
        // TODO: Implement setUser() method.
    }

    private function fetchToken():? string
    {
        if(null !== $token = request()->bearerToken()){
            return $token;
        }

        if(null !== $token = request()->query('_token')){
            return $token;
        }

        return null;
    }

    public function user(): ?Authenticatable
    {
        $token = $this->fetchToken();

        if(null !== $token){
            $config = Configuration::forUnsecuredSigner();
            $user = $config->parser()->parse($token)->claims()->get('jti');
            if($user){
                if(null !== $retrieve = $this->provider->retrieveById($user)){
                    return $retrieve;
                }

                abort(401, "unauthorized.");
            }
        }

        abort(409, "invalid token.");
    }
}