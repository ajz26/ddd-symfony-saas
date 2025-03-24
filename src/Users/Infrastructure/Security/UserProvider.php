<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Security;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Domain\ValueObject\Email;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findByEmail(Email::fromString($identifier));

        if (!$user) {
            throw new UserNotFoundException();
        }

        return new SecurityUser($user);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return SecurityUser::class === $class;
    }
} 