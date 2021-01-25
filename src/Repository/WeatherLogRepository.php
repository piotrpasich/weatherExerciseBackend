<?php

namespace App\Repository;

use App\Entity\City;
use App\Entity\WeatherLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WeatherLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherLog[]    findAll()
 * @method WeatherLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherLog::class);
    }

    public function insert ($weather, City $city) {
        $weatherLog = $this->findOneByDt($weather['dt']);
        if ($weatherLog === NULL) {
            $weatherLog = new WeatherLog();
            $weatherLog->setDt($weather['dt']);
            $weatherLog->setTempMin($weather['main']['temp_min']);
            $weatherLog->setTempMax($weather['main']['temp_max']);
            $weatherLog->setPressure($weather['main']['pressure']);
            $weatherLog->setHumidity($weather['main']['humidity']);
            $weatherLog->setTemp($weather['main']['temp']);
            $weatherLog->setDeg($weather['wind']['deg']);
            $weatherLog->setSpeed($weather['wind']['speed']);
            $weatherLog->setClouds($weather['clouds']['all']);
            $weatherLog->setSunrise($weather['sys']['sunrise']);
            $weatherLog->setSunset($weather['sys']['sunset']);
            $weatherLog->setCity($city);
            $weatherLog->setSnow(isset($weather['snow']) ? ($weather['snow'][key($weather['snow'])]): 0);
            $weatherLog->setPop(isset($weather['pop']) ? ($weather['pop'][key($weather['pop'])]): 0);

            $this->getEntityManager()->persist($weatherLog);
            $this->getEntityManager()->flush();
        }
    }

    // /**
    //  * @return WeatherLog[] Returns an array of WeatherLog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WeatherLog
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
