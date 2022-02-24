<?php

namespace App\Repository;

use App\Entity\Llibre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Llibre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Llibre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Llibre[]    findAll()
 * @method Llibre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LlibreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Llibre::class);
    }

    // /**
    //  * @return Llibre[] Returns an array of Llibre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Llibre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
