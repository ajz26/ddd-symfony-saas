<?php 

declare(strict_types=1);

namespace App\Clients\Domain\Contracts;

interface Client
{
    public function getId(): int;
    public function getName(): string;
}

