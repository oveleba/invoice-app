<?php

namespace Tests\Entity;

use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use PHPUnit\Framework\TestCase;

class InvoiceItemTest extends TestCase
{
    private InvoiceItem $invoiceItem;
    private Invoice $invoice;

    protected function setUp(): void
    {
        parent::setUp();

        $this->invoiceItem = new InvoiceItem();
        $this->invoice = new Invoice();
    }

    public function testGetSetId(): void
    {
        $this->invoiceItem->setId(1);
        $this->assertSame(1, $this->invoiceItem->getId());
    }

    public function testGetSetName(): void
    {
        $this->invoiceItem->setName('Test Item');
        $this->assertSame('Test Item', $this->invoiceItem->getName());
    }

    public function testGetSetQuantity(): void
    {
        $this->invoiceItem->setQuantity(10);
        $this->assertSame(10, $this->invoiceItem->getQuantity());
    }

    public function testGetSetUnitPrice(): void
    {
        $this->invoiceItem->setUnitPrice(19.99);
        $this->assertSame(19.99, $this->invoiceItem->getUnitPrice());
    }

    public function testGetSetInvoice(): void
    {
        $this->invoiceItem->setInvoice($this->invoice);
        $this->assertSame($this->invoice, $this->invoiceItem->getInvoice());
    }
}
