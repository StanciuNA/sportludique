<?php

namespace App\Container;

use App\Entity\Product;
use App\Entity\CartContent;

class CartManager {

    private ?Product $product = null;
    private ?int $quantity = null;
    private ?int $bulkPrice = null;
    private ?CartContent $cartContent = null;

    public function __construct(){
        $this->product = null;
        $this->quantity = null;
        $this->bulkPrice = null;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function setProduct(Product $aProduct): void {
        $this->product = $aProduct;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function setQuantity(int $theQuantity): void {
        $this->quantity = $theQuantity;
    }
    public function getBulkPrice(): int {
        return $this->bulkPrice;
    }

    public function setBulkPrice(): void {
        $this->bulkPrice = $this->getQuantity() * $this->getProduct()->getPrice();
    }

    public function getCartContent(): CartContent {
        return $this->cartContent;
    }

    public function setCartContent(CartContent $theCartContent): void {
        $this->cartContent = $theCartContent;
    }
}

?>