<?php 

namespace App\Cards\Infrastructure\Persistence\Doctrine\Repository;

use App\Cards\Domain\Entity\Card;
use Doctrine\Persistence\ManagerRegistry;
use App\Cards\Domain\Service\CardHydrator;
use App\Cards\Domain\Repository\CardsRepositoryInterface;
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

    public function findOneBy(array $criteria, array $orderBy = null): ?Card 
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('c')
           ->from(Card::class, 'c');

        foreach ($criteria as $field => $value) {
            if (str_contains($field, '.')) {
                $originalField = $field;
                $field = str_replace('.', '_', $field);
                $qb->andWhere("c.$originalField = :$field")
                   ->setParameter($field, $value);
            } else {
                $qb->andWhere("c.$field = :$field")
                   ->setParameter($field, $value);
            }
        }

        if ($orderBy) {
            foreach ($orderBy as $field => $order) {
                $qb->addOrderBy("c.$field", $order);
            }
        }


        return $qb->getQuery()->getOneOrNullResult();
    }

    public function paginate(int $page, int $limit, string $sortBy, string $sort): array
    {
        $results = $this->getEntityManager()->createQueryBuilder()
            ->select('c')
            ->from(Card::class, 'c')
            ->orderBy('c.' . $sortBy, $sort)
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        $pagesCount = ceil(count($results) / $limit);


        return [
            'data' => array_map(fn(Card $card) => $card, $results),
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

   
    public function persistBatch(array $cards): array
    {
        $_cards = [];

        foreach ($cards as $card) {
 
            $this->getEntityManager()->persist($card);

            $_cards[] = $card;
        }

        $this->getEntityManager()->flush();

        return $_cards;
    }
    
    
}