<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $idCategory = null;

    #[ORM\OneToMany(mappedBy: 'idProduct', targetEntity: OrderContent::class)]
    private Collection $orderContents;

    public function __construct()
    {
        $this->orderContents = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->idCategory;
    }

    public function setIdCategory(?Category $idCategory): self
    {
        $this->idCategory = $idCategory;

        return $this;
    }

    public function __toString(): string
        {
            return $this->nom;
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
            $orderContent->setIdProduct($this);
        }

        return $this;
    }

    public function removeOrderContent(OrderContent $orderContent): self
    {
        if ($this->orderContents->removeElement($orderContent)) {
            // set the owning side to null (unless already changed)
            if ($orderContent->getIdProduct() === $this) {
                $orderContent->setIdProduct(null);
            }
        }

        return $this;
    }
}
