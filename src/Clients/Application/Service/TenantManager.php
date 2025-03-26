<?php 

namespace App\Clients\Application\Service;

use App\Clients\Domain\Entity\Client;
use App\Clients\Domain\Repository\ClientRepositoryInterface;
use App\Clients\Domain\Contracts\Client as ClientInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TenantManager
{
    private ?Client $currentClient = null;
    
    public function __construct(
        private readonly ClientRepositoryInterface $clientRepository,
        private readonly ContainerInterface $container
    )
    {
    }
    
    public function client(?Client $client = null): Client
    {
        if ($client !== null) {
            $this->currentClient = $client;
            $this->container->set(ClientInterface::class, $client);
            // $this->eventDispatcher->dispatch(new ClientSwitchedEvent($client));
        }
        return $this->currentClient;
    }
    
}