<?php 

declare(strict_types=1);

namespace App\Clients\Application\Interface;

interface Client
{
    public function getId(): string;
    public function getName(): string;
}
