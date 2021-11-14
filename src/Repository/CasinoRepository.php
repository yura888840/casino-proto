<?php

namespace App\Repository;

use App\Entity\Casino;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Casino|null find($id, $lockMode = null, $lockVersion = null)
 * @method Casino|null findOneBy(array $criteria, array $orderBy = null)
 * @method Casino[]    findAll()
 * @method Casino[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CasinoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Casino::class);
    }

    public function findCasinosByRating()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.rating', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Casino[] Returns an array of Casino objects
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
    public function findOneBySomeField($value): ?Casino
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
