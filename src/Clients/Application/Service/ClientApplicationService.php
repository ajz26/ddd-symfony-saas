<?php 

namespace App\Clients\Application\Service;

use App\Clients\Domain\Entity\Client;
use App\Clients\Domain\Repository\ClientRepositoryInterface;

class ClientApplicationService
{

    public function __construct(
        private readonly ClientRepositoryInterface $clientRepository,
    )
    {
    }

    public function paginate(int $page, int $perPage): array
    {
        return $this->clientRepository->paginate($page, $perPage);
    }
    

    public function createClient(string $name): void
    {
        $client = new Client($name);
        $this->clientRepository->save($client);
    }
    
}