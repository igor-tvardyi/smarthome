<?php

namespace App\Repository;

use App\Entity\SensorData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SensorData|null find($id, $lockMode = null, $lockVersion = null)
 * @method SensorData|null findOneBy(array $criteria, array $orderBy = null)
 * @method SensorData[]    findAll()
 * @method SensorData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SensorDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SensorData::class);
    }

    // /**
    //  * @return Sensor[] Returns an array of Sensor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sensor
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
