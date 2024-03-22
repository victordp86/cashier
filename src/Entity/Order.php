<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="orderRef", orphanRemoval=true)
     */
    private $items;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(OrderItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setOrderRef($this);
        }

        return $this;
    }

    public function removeItem(OrderItem $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getOrderRef() === $this) {
                $item->setOrderRef(null);
            }
        }

        return $this;
    }

    /**
     */
    public function calculateItemsDiscount()
    {
        $currentDiscountGR1 = 2;
        $currentDiscountSR1 = 4.5;
        $currentDiscountCR1 = 2/3;
        var_dump('ENTERS');
        foreach ($this->items as $item){
            /** @item OrderItem */
            if ($item->getProduct()==='GR1'){
                $item->setAmount($item->getAmount() * $currentDiscountGR1);
//               if($item->getAmount() %2 == 1){
//                   $item->setAmount($item->getAmount() + 1 );
//                   $item->setDiscountPrice($item->getDiscountPrice - ($item->getAmount));
//               }
            }

            if ($item->getProduct()==='SR1'){
                if($item->getAmount()>=3){
                    $item->setPrice($currentDiscountSR1);
                    $item->setOrderLinePrice($item->getPrice() * $item->getAmount() );
//                    var_dump($item->getPrice());
//                    var_dump($item->getOrderLinePrice());
                }
            }
            if ($item->getProduct()==='CF1'){
                var_dump('ENTERS');
                if($item->getAmount()>=3){
                    var_dump('ENTERS');
                    var_dump($item->getItemPrice());
                    $discontPrice =  $item->getAmount() * $item->getItemPrice() * $currentDiscountCR1;
                    $discontPrice = number_format($discontPrice,2);
                    var_dump($discontPrice);
                    $item->setOrderLinePrice($discontPrice);
                }

            }
    }
    }

    /**
     * @return float
     */
    public function totalPrice(): float
    {
        $total = 0;
        foreach ($this->items as $item){
          $total = $total +  $item->getOrderLinePrice();

         var_dump($item->getOrderLinePrice());
        }
        return $total;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
