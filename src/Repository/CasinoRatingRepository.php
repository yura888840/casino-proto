<?php

namespace App\Repository;

use App\Entity\CasinoRating;
use App\Entity\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CasinoRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method CasinoRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method CasinoRating[]    findAll()
 * @method CasinoRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CasinoRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CasinoRating::class);
    }
    // /**
    //  * @return CasinoRating[] Returns an array of CasinoRating objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CasinoRating
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
