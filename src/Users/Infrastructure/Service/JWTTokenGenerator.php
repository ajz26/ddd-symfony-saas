<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\TokenGeneratorInterface;
use App\Clients\Domain\Repository\ClientRepositoryInterface;

final class JWTTokenGenerator implements TokenGeneratorInterface
{
    public function __construct(
        private string $secretKey,
        private int $tokenTtl,
        private ClientRepositoryInterface $clientRepository
    ) {
    }

    public function generate(User $user): string
    {
        $client = $this->clientRepository->findById($user->clientId()->value());
        $payload = [
            'sub' => $user->getId(),
            'email' => $user->getEmail()->getValue(),
            'client' => [
                'id' => $client->getId(),
                'name' => $client->getName()
            ],
            'iat' => time(),
            'exp' => time() + $this->tokenTtl
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }
    
    

    public function validate(string $token): ?array
    {
        try {
            return (array) JWT::decode($token, new Key($this->secretKey, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
}