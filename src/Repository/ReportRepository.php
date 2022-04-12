<?php

namespace App\Repository;

use App\Entity\Report;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    /**
     * @param string|null $location
     * @param string|null $from
     * @param string|null $to
     * @return int|mixed|string
     */
    public function findByFilter(string $location = null, string $from = null, string $to = null)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.location = :location AND r.date BETWEEN :dateFrom AND :dateTo')
            ->setParameter('location', $location ?? 'Lodz')
            ->setParameter('dateFrom', $from ?? '2020-01-01 00:00:00')
            ->setParameter('dateTo', $to ?? date('Y-m-d H:i:s'))
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
