<?php

namespace App\Repository;

use App\Entity\Loanables;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Loanables|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loanables|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loanables[]    findAll()
 * @method Loanables[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoanablesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Loanables::class);
    }

    // /**
    //  * @return Loanables[] Returns an array of Loanables objects
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
    public function findOneBySomeField($value): ?Loanables
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
