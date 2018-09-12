<?php

namespace App\Repository;

use App\Entity\FooBar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FooBar|null find($id, $lockMode = null, $lockVersion = null)
 * @method FooBar|null findOneBy(array $criteria, array $orderBy = null)
 * @method FooBar[]    findAll()
 * @method FooBar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FooBarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FooBar::class);
    }

    public function dummyMethodForPOC()
    {
        return true;
    }

    public function dummyMethodForPOCToFail()
    {
        return false;
    }

//    /**
//     * @return FooBar[] Returns an array of FooBar objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FooBar
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
