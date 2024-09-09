<?php
namespace App\Repository;

use App\Entity\Invoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class InvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    public function getCountInvoicesByYear(int $year): int
    {
        $queryBuilder = $this->createQueryBuilder('i');

        $queryBuilder
            ->select('COUNT(i.id)')
            ->where('YEAR(i.issueDate) = :year')
            ->setParameter('year', $year);

        return (int) $queryBuilder->getQuery()->getSingleScalarResult();
    }
}