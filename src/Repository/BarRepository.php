<?php

namespace App\Repository;

use App\Entity\Bar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bar[]    findAll()
 * @method Bar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bar::class);
    }

    /**
     * @param           $entity
     * @param bool|null $flush
     *
     * @return BarRepository
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store($entity = null, bool $flush = null): self
    {
        $flush = $flush ?? false;

        if ($entity !== null) {
            $this->_em->persist($entity);
        }

        if ($flush) {
            $this->_em->flush();
        }

        return $this;
    }

//    /**
//     * @return Bar[] Returns an array of Bar objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bar
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
