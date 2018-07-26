<?php

namespace App\Repository;

use App\Entity\CarnetEntretien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CarnetEntretien|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarnetEntretien|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarnetEntretien[]    findAll()
 * @method CarnetEntretien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarnetEntretienRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CarnetEntretien::class);
    }

//    /**
//     * @return CarnetEntretien[] Returns an array of CarnetEntretien objects
//     */
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
    public function findOneBySomeField($value): ?CarnetEntretien
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
