<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Service;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\TokenGeneratorInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final class JWTTokenGenerator implements TokenGeneratorInterface
{
    public function __construct(
        private string $secretKey,
        private int $tokenTtl
    ) {
    }

    public function generate(User $user): string
    {
        $payload = [
            'sub' => $user->id(),
            'email' => $user->email()->value(),
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