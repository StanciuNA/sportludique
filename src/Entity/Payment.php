<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'payment', targetEntity: Order::class)]
    private Collection $idOrder;

    public function __construct()
    {
        $this->idOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getIdOrder(): Collection
    {
        return $this->idOrder;
    }

    public function addIdOrder(Order $idOrder): self
    {
        if (!$this->idOrder->contains($idOrder)) {
            $this->idOrder->add($idOrder);
            $idOrder->setPayment($this);
        }

        return $this;
    }

    public function removeIdOrder(Order $idOrder): self
    {
        if ($this->idOrder->removeElement($idOrder)) {
            // set the owning side to null (unless already changed)
            if ($idOrder->getPayment() === $this) {
                $idOrder->setPayment(null);
            }
        }

        return $this;
    }
}
