<?php 
namespace App\Cards\Repository;

use App\Cards\Entity\Card;
use App\Cards\Interfaces\Card as CardInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class CardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Card::class);
    }
    
    /**
     * @param CardInterface $card
     * @param boolean $flush
     * @return CardInterface
     */
    public function save(CardInterface $card, bool $flush = false): CardInterface
    {
        $this->getEntityManager()->persist($card);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $card;
    }

    /**
     * 
     *
     * @param [type] $page
     * @param [type] $limit
     * @param [type] $sort_by
     * @param [type] $sort
     * @return array
     */
    public function paginate($page, $limit, $sort_by, $sort) : array
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.' . $sort_by, $sort);


        $paginator = new Paginator($query);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $totalItems = count($paginator);

        $pagesCount = ceil($totalItems / $limit);

        return [
            'data' => $paginator,
            'pagination' => [
                'total' => $totalItems,
                'pages' => $pagesCount
            ]
        ];
    }


    public function persist(CardInterface $card, bool $flush = false): CardInterface
    {
        $this->getEntityManager()->persist($card);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $card;
    }
    

    public function flush()
    {
        $this->getEntityManager()->flush();
    }

}