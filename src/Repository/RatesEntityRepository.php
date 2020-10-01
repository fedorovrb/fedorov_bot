<?php

namespace App\Repository;

use App\Entity\RatesEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RatesEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method RatesEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method RatesEntity[]    findAll()
 * @method RatesEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatesEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RatesEntity::class);
    }

    // /**
    //  * @return RatesEntity[] Returns an array of RatesEntity objects
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
    public function findOneBySomeField($value): ?RatesEntity
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
