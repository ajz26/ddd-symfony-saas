<?php 

declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Doctrine\Repository;

use App\Users\Domain\Entity\User;
use App\Users\Domain\ValueObject\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Clients\Application\Service\TenantManager;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Shared\Infrastructure\Persistence\Cache\CacheableTrait;

final class DoctrineUserRepository implements UserRepositoryInterface
{
    use CacheableTrait;
    
    public function __construct(
        private EntityManagerInterface $entityManager,
        private TenantManager $tenantManager,
        private CacheInterface $cache
    ) {
    }

    public function save(User $user): User
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function findById($id): ?User
    {
        $key = $this->getCacheKey('findById', [$id]);

        return $this->cacheItem($key, function() use ($id) {
            return $this->entityManager->getRepository(User::class)->find($id);
        });
    }

    public function findByEmail(Email $email): ?User
    {
        $key = $this->getCacheKey('findByEmail', [$email->value()]);   
        
        return $this->cacheItem($key, function() use ($email) {
            return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email->value()]);
        });
    }

    public function delete(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function paginate(int $page = 1, int $limit = 10): array
    {
        $query = $this->entityManager->createQueryBuilder()
            ->select('PARTIAL u.{id, email, firstName, lastName}')
            ->from(User::class, 'u')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        
        if ($this->tenantManager->client() !== null) {
            $query->where('u.clientId = :clientId')
                ->setParameter('clientId', $this->tenantManager->client()->getId());
        }


        $paginator = new Paginator($query);

        $count = $paginator->count();


        return [
            'data' => $paginator->getQuery()->getResult(),
            'page' => $page,
            'limit' => $limit,
            'total' => $count,
        ];
    }
} 