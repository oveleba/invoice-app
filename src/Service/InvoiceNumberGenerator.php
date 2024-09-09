<?php
namespace App\Service;

use App\Repository\InvoiceRepository;

class InvoiceNumberGenerator
{
    public function __construct(private InvoiceRepository $invoiceRepository)
    {
    }

    public function generateInvoiceNumber(\DateTimeInterface $issueDate): string
    {
        $year = $issueDate->format('Y');

        $countInvoicesByYear = $this->invoiceRepository->getCountInvoicesByYear($year);

        return sprintf('%s%04d', $year, $countInvoicesByYear + 1);
    }
}