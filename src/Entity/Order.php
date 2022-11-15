<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Status $idStatus = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idPerson = null;

    #[ORM\OneToMany(mappedBy: 'idOrder', targetEntity: OrderContent::class)]
    private Collection $orderContents;

    public function __construct()
    {
        $this->orderContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdStatus(): ?Status
    {
        return $this->idStatus;
    }

    public function setIdStatus(?Status $idStatus): self
    {
        $this->idStatus = $idStatus;

        return $this;
    }

    public function getIdPerson(): ?User
    {
        return $this->idPerson;
    }

    public function setIdPerson(?User $idPerson): self
    {
        $this->idPerson = $idPerson;

        return $this;
    }

    /**
     * @return Collection<int, OrderContent>
     */
    public function getOrderContents(): Collection
    {
        return $this->orderContents;
    }

    public function addOrderContent(OrderContent $orderContent): self
    {
        if (!$this->orderContents->contains($orderContent)) {
            $this->orderContents->add($orderContent);
            $orderContent->setIdOrder($this);
        }

        return $this;
    }

    public function removeOrderContent(OrderContent $orderContent): self
    {
        if ($this->orderContents->removeElement($orderContent)) {
            // set the owning side to null (unless already changed)
            if ($orderContent->getIdOrder() === $this) {
                $orderContent->setIdOrder(null);
            }
        }

        return $this;
    }
}
