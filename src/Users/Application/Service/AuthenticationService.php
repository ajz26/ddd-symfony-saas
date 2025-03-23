<?php

declare(strict_types=1);

namespace App\Users\Application\Service;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Domain\ValueObject\Email;
use App\Users\Domain\Exception\InvalidCredentialsException;

final class AuthenticationService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function authenticate(string $email, string $plainPassword): User
    {
        $user = $this->userRepository->findByEmail(Email::fromString($email));

        if ($user === null) {
            throw new InvalidCredentialsException('Credenciales inválidas');
        }

        if (!$user->verifyPassword($plainPassword)) {
            throw new InvalidCredentialsException('Credenciales inválidas');
        }

        return $user;
    }
} 