<?php
namespace App\Entity;

use App\Repository\InvoiceItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity()]
#[ORM\Table(name: 'invoice_item')]
class InvoiceItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive]
    #[Assert\NotBlank]
    private int $quantity;

    #[ORM\Column(type: 'float', name: 'unit_price')]
    #[Assert\PositiveOrZero]
    #[Assert\NotBlank]
    private float $unitPrice;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'items')]
    #[ORM\JoinColumn(name: 'invoice_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Invoice $invoice = null;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice = null)
    {
        $this->invoice = $invoice;
    }

}