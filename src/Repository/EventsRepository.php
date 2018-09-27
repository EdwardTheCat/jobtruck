<?php

namespace App\Repository;

use App\Entity\Events;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Events|null find($id, $lockMode = null, $lockVersion = null)
 * @method Events|null findOneBy(array $criteria, array $orderBy = null)
 * @method Events[]    findAll()
 * @method Events[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Events::class);
    }

//    /**
//     * @return Events[] Returns an array of Events objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Events
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    //function to get recents event from now
    public function findEventsAfter(\DateTime $createdBefore)
    {
    return $this->createQueryBuilder('m')
                ->where("m.date > ?1")
                ->setParameter(1, $createdBefore)
                ->getQuery()
                ->getResult();
    }

    //function to get the most recent event
    public function findOneEventAfter(\DateTime $createdBefore)
    {
        $limit=1;

        return $this->createQueryBuilder('m')
                ->where("m.date > ?1")
                ->setParameter(1, $createdBefore)
                ->orderBy('m.date', 'ASC')
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult();
    }
}
