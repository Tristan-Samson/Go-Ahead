<?php

namespace App\Repository;

use App\Entity\Quest;
use App\Entity\Validation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quest[]    findAll()
 * @method Quest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quest::class);
    }

    // /**
    //  * @return Quest[] Returns an array of Quest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findPersonnalQuestsByUser($userid)
    {
        return $this->createQueryBuilder('q')
        ->andWhere('q.type = 3')
        ->andWhere('v.user_id = :userid')
        ->leftJoin('q.validations', 'v')
        ->setParameter('userid', $userid)
        ->getQuery()
        ->getResult();
    }

    public function findAllValid()
    {
        return $this->createQueryBuilder('q')
        ->andWhere('v.is_valid = true')
        ->leftJoin('q.validations', 'v')
        ->getQuery()
        ->getResult();
    }
    /*
    public function findOneBySomeField($value): ?Quest
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
