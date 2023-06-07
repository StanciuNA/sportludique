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


    #[ORM\ManyToOne(inversedBy: 'idOrder')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Payment $payment = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $amount = null;

    #[ORM\ManyToOne(inversedBy: 'idorder')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adress $adress = null;


    #[ORM\Column(nullable: true)]
    private ?float $totalPrice = null;

    #[ORM\OneToMany(mappedBy: 'purchase', targetEntity: CartContent::class)]
    private Collection $content;


    public function __construct()
    {
        $this->content = new ArrayCollection();
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




    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(?Payment $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAdress(): ?Adress
    {
        return $this->adress;
    }

    public function setAdress(?Adress $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return Collection<int, CartContent>
     */
    public function getContent(): Collection
    {
        return $this->content;
    }

    public function addContent(CartContent $content): self
    {
        if (!$this->content->contains($content)) {
            $this->content->add($content);
            $content->setPurchase($this);
        }

        return $this;
    }

    public function removeContent(CartContent $content): self
    {
        if ($this->content->removeElement($content)) {
            // set the owning side to null (unless already changed)
            if ($content->getPurchase() === $this) {
                $content->setPurchase(null);
            }
        }

        return $this;
    }

}
