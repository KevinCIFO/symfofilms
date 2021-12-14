<?php

namespace App\Repository;

use App\Entity\Actor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Actor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actor[]    findAll()
 * @method Actor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actor::class);
    }

    // /**
    //  * @return Actor[] Returns an array of Actor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Actor
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    // public function findAgeActors(EntityManagerInterface $em): Response
    // {
    //     $actores = $em->createQuery (
    //             'SELECT YEAR(CURRENT_DATE())-a.fechaNacimiento AS edad
    //             --  SELECT a.nombre, DATE_DIFF(CURRENT_DATE(), a.fechaNacimiento)/366 AS edad
    //              FROM App\Entity\Actor a
    //              ORDER BY edad DESC'
    //     )
    //     ->getResult();

    //     $resultado = '';

    //     foreach($actores as $actor) {
    //         //$resultado .= implode(' - ', $actor).' años<br>';
    //         $resultado .= $actor['edad'].' años<br>';
    //     }

    //     return $resultado;
    // }
}
