<?php

namespace App\Entity;

use App\Repository\CartContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartContentRepository::class)]
class CartContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'cartContents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cart $cartId = null;

    #[ORM\OneToMany(mappedBy: 'cartContent', targetEntity: Product::class)]
    private Collection $Idperson;

    #[ORM\ManyToOne(inversedBy: 'cartContents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $productId = null;

    #[ORM\ManyToOne(inversedBy: 'content')]
    private ?Order $purchase = null;

    public function __construct()
    {
        $this->Idperson = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCartId(): ?Cart
    {
        return $this->cartId;
    }

    public function setCartId(?Cart $cartId): self
    {
        $this->cartId = $cartId;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getIdperson(): Collection
    {
        return $this->Idperson;
    }

    public function getProductId(): ?Product
    {
        return $this->productId;
    }

    public function setProductId(?Product $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getPurchase(): ?Order
    {
        return $this->purchase;
    }

    public function setPurchase(?Order $purchase): self
    {
        $this->purchase = $purchase;

        return $this;
    }
}
