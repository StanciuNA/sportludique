<?php

namespace App\Entity;

use App\Repository\OrderContentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderContentRepository::class)]
class OrderContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderContents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $idProduct = null;

    #[ORM\ManyToOne(inversedBy: 'orderContents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $idOrder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduct(): ?Product
    {
        return $this->idProduct;
    }

    public function setIdProduct(?Product $idProduct): self
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    public function getIdOrder(): ?Order
    {
        return $this->idOrder;
    }

    public function setIdOrder(?Order $idOrder): self
    {
        $this->idOrder = $idOrder;

        return $this;
    }
}
