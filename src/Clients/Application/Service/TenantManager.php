<?php 

namespace App\Clients\Application\Service;

use App\Clients\Domain\Entity\Client;
use App\Shared\Domain\Event\EventDispatcher;
use App\Clients\Domain\Event\ClientSwitchedDomainEvent;
use App\Clients\Domain\Contracts\Client as ClientInterface;
use App\Clients\Domain\Repository\ClientRepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TenantManager
{
    private ?Client $currentClient = null;
    
    public function __construct(
        private readonly ClientRepositoryInterface $clientRepository,
        private readonly ContainerInterface $container,
        private readonly EventDispatcher $eventDispatcher
    )
    {
    }
    
    public function client(?Client $client = null): Client
    {
        if ($client !== null) {
            $this->currentClient = $client;
            $this->container->set(ClientInterface::class, $client);
            $this->eventDispatcher->dispatch(ClientSwitchedDomainEvent::fromClient($client));
        }
        return $this->currentClient;
    }
    
}