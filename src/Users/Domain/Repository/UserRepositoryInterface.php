<?php 

declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\User;
use App\Users\Domain\ValueObject\Email;

interface UserRepositoryInterface
{
    public function save(User $user): User;
    
    public function findById($id): ?User;
    
    public function findByEmail(Email $email): ?User;
    
    public function delete(User $user): void;
} 