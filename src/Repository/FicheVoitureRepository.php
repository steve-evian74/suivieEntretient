<?php

namespace App\Repository;

use App\Entity\FicheVoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FicheVoiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheVoiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheVoiture[]    findAll()
 * @method FicheVoiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheVoitureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FicheVoiture::class);
    }

//    /**
//     * @return FicheVoiture[] Returns an array of FicheVoiture objects
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
    public function findOneBySomeField($value): ?FicheVoiture
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
