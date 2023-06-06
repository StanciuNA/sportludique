<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;



#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'idCategory', targetEntity: Product::class)]
    private Collection $products;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'id_categ_parent')]
    private ?self $categ_parent = null;

    #[ORM\OneToMany(mappedBy: 'categ_parent', targetEntity: self::class)]
    private Collection $id_categ_parent;



    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->id_categ_parent = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->label;
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
    

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setIdCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getIdCategory() === $this) {
                $product->setIdCategory(null);
            }
        }

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

    public function getCategParent(): ?self
    {
        return $this->categ_parent;
    }

    public function setCategParent(?self $categ_parent): self
    {
        $this->categ_parent = $categ_parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getIdCategParent(): Collection
    {
        return $this->id_categ_parent;
    }

    public function addIdCategParent(self $idCategParent): self
    {
        if (!$this->id_categ_parent->contains($idCategParent)) {
            $this->id_categ_parent->add($idCategParent);
            $idCategParent->setCategParent($this);
        }

        return $this;
    }

    public function removeIdCategParent(self $idCategParent): self
    {
        if ($this->id_categ_parent->removeElement($idCategParent)) {
            // set the owning side to null (unless already changed)
            if ($idCategParent->getCategParent() === $this) {
                $idCategParent->setCategParent(null);
            }
        }

        return $this;
    }

   

   
}
