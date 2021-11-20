<?php

namespace App\Repository;

use App\Entity\RatingsRate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RatingsRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method RatingsRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method RatingsRate[]    findAll()
 * @method RatingsRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatingsRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RatingsRate::class);
    }

    // /**
    //  * @return RatingsRate[] Returns an array of RatingsRate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RatingsRate
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
