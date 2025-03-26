<?php 

declare(strict_types=1);

namespace App\Shared\Infrastructure\Service;

use App\Clients\Domain\Entity\Client;
use App\Users\Infrastructure\Security\SecurityUser;
use App\Clients\Domain\Repository\ClientRepositoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class CurrentClientProvider
{
    public function __construct(
        private readonly TokenStorageInterface $tokenStorage,
        private readonly ClientRepositoryInterface $clientRepository
    ) {
    }

    public function getClient(): Client
    {
        $token = $this->tokenStorage->getToken();
        
        if (null === $token) {
            throw new \RuntimeException('No hay usuario autenticado');
        }

        $securityUser = $token->getUser();

        if (!$securityUser instanceof SecurityUser) {
            throw new \RuntimeException('No hay usuario autenticado');
        }


        $user = $securityUser->getUser();

        $clientId = $user->getClientId();

        $client =  $this->clientRepository->findById($clientId->value());

        if (!$client) {
            throw new \RuntimeException('No hay cliente autenticado');
        }

        return $client;
    }
} 