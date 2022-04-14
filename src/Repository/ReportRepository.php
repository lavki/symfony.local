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

    public function findByFilter(FilterFormDTO $dto)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.location = :location AND r.date BETWEEN :dateFrom AND :dateTo')
            ->setParameter('location', $dto->location ?? 'Lodz')
            ->setParameter('dateFrom', $dto->dateFrom ?? '2020-01-01 00:00:00')
            ->setParameter('dateTo', $dto->dateTo ?? date('Y-m-d H:i:s'))
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
