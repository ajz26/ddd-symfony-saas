<?php

declare(strict_types=1);

namespace App\Users\Domain\Service;

use App\Users\Domain\Entity\User;

interface TokenGeneratorInterface
{
    public function generate(User $user): string;
    public function validate(string $token): ?array;
}