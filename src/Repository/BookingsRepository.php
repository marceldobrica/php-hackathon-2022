<?php

namespace App\Repository;

use App\Entity\Bookings;
use App\Entity\Program;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bookings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bookings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bookings[]    findAll()
 * @method Bookings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bookings::class);
    }

    /**
     * @param String $cnp
     * @param Program $program
     * @return array
     */
    public function validateBookingProgram(String $cnp, Program $program): array
    {
        $a = $this->createQueryBuilder('b')
            ->select('COUNT(b.cnp) AS TOTAL')
            ->innerJoin('b.program' , 'p')
            ->Where('b.cnp = :cnp AND p.endDateTime> :startdate AND p.startDateTime < :startdate')
            ->orWhere('b.cnp = :cnp AND p.endDateTime> :enddate AND p.startDateTime < :enddate')
            ->setParameter(':cnp', $cnp)
            ->setParameter(':startdate', $program->getStartDateTime())
            ->setParameter(':enddate', $program->getEndDateTime())
            ->getQuery();
        return $a->getResult();


    }

    // /**
    //  * @return Bookings[] Returns an array of Bookings objects
    //  */
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
    public function findOneBySomeField($value): ?Bookings
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
