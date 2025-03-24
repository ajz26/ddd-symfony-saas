<?php 

namespace App\Clients\Domain\Repository;

use App\Clients\Domain\Entity\Client;

interface ClientRepositoryInterface
{

    public function findAll(): array;

    public function findById(int $id): Client;

    public function save(Client $client): void;

    public function paginate(int $page, int $perPage): array;

}
