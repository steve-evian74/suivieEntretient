<?php

namespace App\Repository;

use App\Entity\CategorieIntervention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategorieIntervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieIntervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieIntervention[]    findAll()
 * @method CategorieIntervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieInterventionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategorieIntervention::class);
    }

//    /**
//     * @return CategorieIntervention[] Returns an array of CategorieIntervention objects
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
    public function findOneBySomeField($value): ?CategorieIntervention
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
