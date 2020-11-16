<?php

namespace App\Repository;

use App\Entity\ImagesConsolesMini;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImagesConsolesMini|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImagesConsolesMini|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImagesConsolesMini[]    findAll()
 * @method ImagesConsolesMini[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesConsolesMiniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImagesConsolesMini::class);
    }

    // /**
    //  * @return ImagesConsolesMini[] Returns an array of ImagesConsolesMini objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImagesConsolesMini
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
