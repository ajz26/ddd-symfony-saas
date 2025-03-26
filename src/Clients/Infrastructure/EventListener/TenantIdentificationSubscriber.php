<?php
namespace App\Clients\Infrastructure\EventListener;

use App\Users\Domain\Entity\User;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Clients\Application\Service\TenantManager;
use App\Users\Infrastructure\Security\SecurityUser;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Shared\Infrastructure\Service\CurrentClientProvider;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TenantIdentificationSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly CurrentClientProvider $currentClientProvider,
        private TenantManager $tenantManager,
        private TokenStorageInterface $tokenStorage
    ) {
    }
    
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', -10]
        ];
    }
    
    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }



        // Verificar si hay un token de autenticación y un usuario autenticado
        $token = $this->tokenStorage->getToken();
                
        if (null === $token) {
            return;
        }

        $securityUser = $token->getUser();

        if (!$securityUser instanceof SecurityUser) {
            return;
        }

        $client = $this->currentClientProvider->getClient();

        $this->tenantManager->client($client);

    }
}