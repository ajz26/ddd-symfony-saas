<?php 

namespace App\Cards\Infrastructure\Persistence\Doctrine\Repository;

use App\Cards\Domain\Entity\Card;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Cards\Domain\Repository\CardsRepositoryInterface;
use App\Cards\Infrastructure\Persistence\Doctrine\CardHydrator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineCardRepository extends ServiceEntityRepository implements CardsRepositoryInterface
{

    public function __construct(ManagerRegistry $registry, private readonly CardHydrator $hydrator)
    {
        parent::__construct($registry, Card::class);
    }


    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?Card
    {
        return $this->getEntityManager()->find(Card::class, $id);
    }

    public function paginate(int $page, int $limit, string $sortBy, string $sort): array
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('PARTIAL c.{id}')
            ->from(Card::class, 'c')
            ->orderBy('c.' . $sortBy, $sort)
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit)
            ->getQuery();

        $results = $query->getResult();

        $pagesCount = ceil(count($results) / $limit);

        return [
            'data' => array_map(fn(Card $Card) => $this->hydrator->extract($Card), $results),
            'pagination' => [
                'total' => count($results),
                'pages' => $pagesCount
            ]
        ];
    }

    public function save(Card $card): ?Card
    {
        $this->getEntityManager()->persist($card);
        $this->getEntityManager()->flush();
        return $card;
    }
    
}