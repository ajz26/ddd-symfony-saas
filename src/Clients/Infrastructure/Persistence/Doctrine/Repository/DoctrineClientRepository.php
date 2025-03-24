<?php 

namespace App\Clients\Infrastructure\Persistence\Doctrine\Repository;

use App\Clients\Domain\Entity\Client;
use Doctrine\Persistence\ManagerRegistry;
use App\Clients\Domain\Repository\ClientRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


class DoctrineClientRepository extends ServiceEntityRepository implements ClientRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function findById(int $id): Client
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function save(Client $client): void
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
    }
    

    public function paginate(int $page, int $perPage): array
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.createdAt', 'DESC')
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage);
        
        $result = $query->getQuery()->getResult();


        $total  = 0 ;

        return [
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
        ];
    }
}