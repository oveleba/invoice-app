<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity()]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private string $customer;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private string $supplier;

    #[ORM\Column(type: 'datetime', name: 'issue_date')]
    #[Assert\NotBlank]
    private \DateTimeInterface $issueDate;

    #[ORM\Column(type: 'datetime', name: 'due_date')]
    #[Assert\NotBlank]
    private \DateTimeInterface $dueDate ;

    #[ORM\Column(type: 'datetime', name: 'tax_date')]
    #[Assert\NotBlank]
    private \DateTimeInterface $taxDate ;

    #[ORM\Column(type: 'string', length: 255, name: 'payment_method')]
    #[Assert\NotBlank]
    private string $paymentMethod ;

    #[ORM\Column(type: 'string', length: 255, unique: true, name: 'invoice_number')]
    #[Assert\NotBlank]
    private string $invoiceNumber;

    #[ORM\Column(type: 'float', name: 'total_amount')]
    private float $totalAmount = 0.0;

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: InvoiceItem::class, cascade: ['persist', 'remove'])]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer)
    {
        $this->customer = $customer;
    }

    public function getSupplier(): string
    {
        return $this->supplier;
    }

    public function setSupplier(string $supplier): void
    {
        $this->supplier = $supplier;
    }

    public function getIssueDate(): \DateTimeInterface
    {
        return $this->issueDate;
    }

    public function setIssueDate(\DateTimeInterface $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    public function getDueDate(): \DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTimeInterface $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    public function getTaxDate(): \DateTimeInterface
    {
        return $this->taxDate;
    }

    public function setTaxDate(\DateTimeInterface $taxDate): void
    {
        $this->taxDate = $taxDate;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): void
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(float $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(InvoiceItem $item): void
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setInvoice($this);
        }
    }

    public function removeItem(InvoiceItem $item): void
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            if ($item->getInvoice() === $this) {
                $item->setInvoice(null);
            }
        }
    }

    public function calculateTotalAmount(): float
    {
        $total = 0.0;

        foreach ($this->items as $item) {
            $total += $item->getQuantity() * $item->getUnitPrice();
        }

        return $total;
    }

    public function updateTotalAmount(): void
    {
        $this->totalAmount = $this->calculateTotalAmount();
    }
}
