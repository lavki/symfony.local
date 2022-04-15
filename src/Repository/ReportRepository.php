<?php

namespace App\Repository;

use App\Entity\Report;
use App\DTO\FilterFormDTO;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function findByFilter(FilterFormDTO $params)
    {
        if ($params->location && $params->location !== 'All') {
            return $this->getReportsByLocation($params);
        }
        
        return $this->getReportsByDate($params);
    }
    
    private function getReportsByLocation(FilterFormDTO $params) {
        return $this->createQueryBuilder('r')
            ->andWhere('r.location = :location AND r.date BETWEEN :dateFrom AND :dateTo')
            ->setParameter('location', $params->location)
            ->setParameter('dateFrom', $params->dateFrom ?? '2020-01-01 00:00:00')
            ->setParameter('dateTo', $params->dateTo ?? date('Y-m-d H:i:s'))
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    
    private function getReportsByDate(FilterFormDTO $params) {
        return $this->createQueryBuilder('r')
            ->andWhere('r.date BETWEEN :dateFrom AND :dateTo')
            ->setParameter('dateFrom', $params->dateFrom ?? '2020-01-01 00:00:00')
            ->setParameter('dateTo', $params->dateTo ?? date('Y-m-d H:i:s'))
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
