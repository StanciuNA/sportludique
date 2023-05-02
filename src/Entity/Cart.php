<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idPerson = null;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: Order::class)]
    private Collection $idOrder;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'carts')]
    private Collection $products;

    #[ORM\OneToMany(mappedBy: 'cartId', targetEntity: CartContent::class)]
    private Collection $cartContents;

    public function __construct()
    {
        $this->idOrder = new ArrayCollection();
        $this->cartContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $idOrder->setCart($this);
        }

        return $this;
    }

    public function removeIdOrder(Order $idOrder): self
    {
        if ($this->idOrder->removeElement($idOrder)) {
            // set the owning side to null (unless already changed)
            if ($idOrder->getCart() === $this) {
                $idOrder->setCart(null);
            }
        }

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
     * @return Collection<int, CartContent>
     */
    public function getCartContents(): Collection
    {
        return $this->cartContents;
    }

    public function addCartContent(CartContent $cartContent): self
    {
        if (!$this->cartContents->contains($cartContent)) {
            $this->cartContents->add($cartContent);
            $cartContent->setCartId($this);
        }

        return $this;
    }

    public function removeCartContent(CartContent $cartContent): self
    {
        if ($this->cartContents->removeElement($cartContent)) {
            // set the owning side to null (unless already changed)
            if ($cartContent->getCartId() === $this) {
                $cartContent->setCartId(null);
            }
        }

        return $this;
    }

}
