<?php
declare(strict_types=1);

namespace Chat\User\Command\Authentication;

use Chat\User\Finder\UserFinder;
use Chat\User\Model\User;
use Illuminate\Validation\UnauthorizedException;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Plain;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class UserAuthenticationHandler
{
    private string $secretKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxM80m4C4Gp6oJ1RZAcpi
                        qOkmzWAgVdTniDCibcJ8t9jWpCo8JqMC4xJyK8IRKQ1MUuKMl7dUR8Czm251FGB8
                        m2O9ei6FvY2KJM3crVKzNujCx0jqgTkyLqhpn6QtZj0rdzRwIoRBBp5+V+uR3nKz
                        OFWrmsdyUwo+smWUVLC83pfu315cF1YxNIdAaN5DWrZp9xaIXg9OM/dLAFkOOdhi
                        9yr5/jPqwy+DMH6+mJ9JOiZ3Lme4WyGgda81/GJG0NHBrmKb8qvDsdZmnruX5bO5
                        ET8rv/O2tebweD45CnwCaMQnwdbp/+KsWk63MdnxChUPiG1VEMQXrcBK7WWp8GL8
                        ywIDAQAB';

    public function __construct(
        private UserFinder $userFinder
    )
    {
    }

    public function handle(UserAuthentication $message)
    {
        if(null !== $user = $this->userFinder->findByPhone($message->getPhone())){
            if($message->getPhone() === $user->phone){
                return $this->authentication($user);
            }
        }

        abort('401', "unauthorized");
    }


    public function authentication(User $user): array
    {
        $token = $this->generateToken($user);

        return ['token' => $token->toString()];
    }

    private function generateToken(User $user): Plain
    {
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText($this->secretKey)
        );

        $now = new \DateTimeImmutable();

        return $config->builder(ChainedFormatter::default())
            ->issuedBy(env('APP_URL')) // Set the issuer
            ->permittedFor(env('APP_URL')) // Set the audience
            ->identifiedBy((string) $user->id) // Token ID
            ->issuedAt($now) // Issued at
            ->expiresAt($now->modify('+1 month')) // Token expiration
            ->withClaim('uid', $user->id) // Custom claim
            ->getToken($config->signer(), $config->signingKey());
    }
}