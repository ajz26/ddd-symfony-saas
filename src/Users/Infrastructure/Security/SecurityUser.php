<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Security;

use App\Users\Domain\Entity\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class SecurityUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private readonly User $user
    ) {
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getPassword(): ?string
    {
        return $this->user->getPassword()->value();
    }

    public function getUserIdentifier(): string
    {
        return $this->user->email()->value();
    }

    public function eraseCredentials(): void
    {
        // No es necesario implementar nada aquí
    }

    public function getUser(): User
    {
        return $this->user;
    }
} 