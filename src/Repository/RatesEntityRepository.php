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

    /**
     * @param $value
     * @return RatesEntity[] Returns an array of RatesEntity objects
     */
    public function findByBank($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.bank = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult()
        ;
    }

}
