<?php 

declare(strict_types=1);

namespace App\Users\Application\Service;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepositoryInterface;


final class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function createUser(User $user) : User
    {
        $this->userRepository->save($user);

        return $user;
    }

    public function paginate(int $page = 1, int $limit = 10): array
    {
        return $this->userRepository->paginate($page, $limit);
    }
}