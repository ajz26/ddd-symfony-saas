<?php 

namespace App\Clients\Infrastructure\Persistence\Doctrine\Repository;

use App\Clients\Domain\Entity\Client;
use Doctrine\Persistence\ManagerRegistry;
use App\Clients\Domain\Repository\ClientRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Shared\Infrastructure\Persistence\Cache\CacheableTrait;
use Symfony\Contracts\Cache\CacheInterface;

class DoctrineClientRepository extends ServiceEntityRepository implements ClientRepositoryInterface
{
    use CacheableTrait;

    public function __construct(
        ManagerRegistry $registry,
        CacheInterface $cache
    ) {
        parent::__construct($registry, Client::class);
        $this->cache = $cache;
    }

    public function findById(int $id): Client
    {
        return $this->cacheItem(
            $this->getCacheKey('findById', [$id]),
            fn() => parent::findOneBy(['id' => $id])
        );
    }

    public function save(Client $client): void
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
        
        // Invalidar solo las claves que necesitamos
        $this->invalidateCache($this->getCacheKey('findById', [$client->getId()]));
        $this->invalidateCache($this->getCacheKey('paginate_*'));
    }

    public function findAll(): array
    {
        // Este método no usa caché
        return parent::findAll();
    }

    public function paginate(int $page, int $perPage): array
    {
        $query = $this->createQueryBuilder('c')
                    ->orderBy('c.createdAt', 'DESC')
                    ->setFirstResult(($page - 1) * $perPage)
                    ->setMaxResults($perPage);
                
                $result = $query->getQuery()->getResult();
                $total = 0;

                return [
                    'data' => $result,
                    'total' => $total,
                    'page' => $page,
                    'perPage' => $perPage,
                ];
    }
}