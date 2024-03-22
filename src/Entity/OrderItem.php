<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 */
class OrderItem
{
    // ...
    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderRef;
    /** @var string */
    private $product;

    /** @var float */
    private $amount;

    /** @var float */
    private $orderamount;

    /** @var float */
    private $discountapplied;

    // ...
    public function getOrderRef(): ?Order
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Order $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct(string $product): void
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getOrderamount()
    {
        return $this->orderamount;
    }

    /**
     * @param mixed $orderamount
     */
    public function setOrderamount($orderamount): void
    {
        $this->orderamount = $orderamount;
    }

    /**
     * @return mixed
     */
    public function getDiscountapplied()
    {
        return $this->discountapplied;
    }

    /**
     * @param mixed $discountapplied
     */
    public function setDiscountapplied($discountapplied): void
    {
        $this->discountapplied = $discountapplied;
    }

}
