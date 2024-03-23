<?php

use PHPUnit\Framework\TestCase;

require_once 'src/Entity/Order.php';
require_once 'src/Entity/OrderItem.php';

class MyClassTest extends TestCase
{
    private $myOrder;
    private $myOrderItem1;
    private $myOrderItem2;
    private $myOrderItem3;

    public function setUp(): void
    {
        $this->myOrder = new \App\Entity\Order();
    }

    public function tearDown(): void
    {
    }

    public function testProductIsAddedToOrder()
    {

        //Arrange
        $this->myOrderItem1 = new \App\Entity\OrderItem();

        //Act
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("GR1");
        $this->myOrder->addItem($this->myOrderItem1);

        //Assert
        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');

        $this->myOrder->removeItem($this->myOrderItem1);
    }

    public function testTwoProductsAreAddedToOrder()
    {
//
        //Arrange
        $this->myOrderItem1 = new \App\Entity\OrderItem();
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("GR1");

        //Act
        $this->myOrder->addItem($this->myOrderItem1);


        $this->myOrderItem2 = new \App\Entity\OrderItem();
        $this->myOrderItem2->setOrderRef($this->myOrder);
        $this->myOrderItem2->setProduct("SR1");
        $this->myOrder->addItem($this->myOrderItem2);

        //Assert
        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');
        $this->assertEquals($this->myOrder->getItems()[1]->getProduct(), 'SR1');


    }

    public function testThreeProductsAreAddedToOrder()
    {
//
        //Arrange
        $this->myOrderItem1 = new \App\Entity\OrderItem();
        $this->myOrderItem2 = new \App\Entity\OrderItem();
        $this->myOrderItem3 = new \App\Entity\OrderItem();

        //Act
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("GR1");

        $this->myOrder->addItem($this->myOrderItem1);

        $this->myOrderItem2->setOrderRef($this->myOrder);
        $this->myOrderItem2->setProduct("SR1");

        $this->myOrder->addItem($this->myOrderItem2);

        $this->myOrderItem3->setOrderRef($this->myOrder);
        $this->myOrderItem3->setProduct("CF1");

        $this->myOrder->addItem($this->myOrderItem3);

        //Assert
        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');
        $this->assertEquals($this->myOrder->getItems()[1]->getProduct(), 'SR1');
        $this->assertEquals($this->myOrder->getItems()[2]->getProduct(), 'CF1');


    }

    public function testWhenAddedTwoGreenTeasWeHaveOneFree()
    {

        //Arrange
        $this->myOrderItem1 = new \App\Entity\OrderItem();

        //Act
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("GR1");
        $this->myOrderItem1->setAmount(1);
        $this->myOrderItem1->setOrderLinePrice(3.11);
        $this->myOrderItem1->setItemPrice(3.11);
        $this->myOrder->addItem($this->myOrderItem1);

        $this->myOrder->calculateItemsDiscount();

        //Assert
        $this->assertEquals($this->myOrderItem1->getAmount(), 2);
        $this->assertEquals($this->myOrder->totalPrice(), 3.11);

    }

    public function testWhenAddedThreeStrawberriesPricesLowersToFourFifty()

    {

        //Arrange
        $this->myOrderItem1 = new \App\Entity\OrderItem();

        //Act
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("SR1");
        $this->myOrderItem1->setAmount(3);
        $this->myOrderItem1->setOrderLinePrice(5);
        $this->myOrderItem1->setItemPrice(5);
        $this->myOrder->addItem($this->myOrderItem1);

        $this->myOrder->calculateItemsDiscount();

        //Assert
        $this->assertEquals($this->myOrder->totalPrice(), 13.50);

    }


    public function testWhenAddedThreeCoffeesPricesLowersToTwoThirdsOfItsOriginalPrice()
    {

        //Arrange
        $this->myOrderItem1 = new \App\Entity\OrderItem();

        //Act
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("CF1");
        $this->myOrderItem1->setAmount(3);
        $this->myOrderItem1->setItemPrice(11.23);
        $this->myOrder->addItem($this->myOrderItem1);

        $this->myOrder->calculateItemsDiscount();

        //Assert
        $this->assertEquals($this->myOrder->totalPrice(), 22.46);

    }

    public function testWhenAddedThreeStrawberriesAndOneGreenTea()
    {

        //Arrange
        $this->myOrderItem1 = new \App\Entity\OrderItem();
        $this->myOrderItem2 = new \App\Entity\OrderItem();

        //Act
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("SR1");
        $this->myOrderItem1->setAmount(3);
        $this->myOrderItem1->setOrderLinePrice(5);
        $this->myOrderItem1->setItemPrice(5);
        $this->myOrder->addItem($this->myOrderItem1);

        $this->myOrderItem2->setOrderRef($this->myOrder);
        $this->myOrderItem2->setProduct("GR1");
        $this->myOrderItem2->setAmount(1);
        $this->myOrderItem2->setOrderLinePrice(3.11);
        $this->myOrderItem2->setItemPrice(3.11);
        $this->myOrder->addItem($this->myOrderItem2);

        $this->myOrder->calculateItemsDiscount();

        //Assert
        $this->assertEquals($this->myOrder->totalPrice(), 16.61);

    }

    public function testWhenAddedThreeCoffesOneStrawberrieAndOneGreenTea()
    {

        //Arrange
        $this->myOrderItem1 = new \App\Entity\OrderItem();
        $this->myOrderItem2 = new \App\Entity\OrderItem();
        $this->myOrderItem3 = new \App\Entity\OrderItem();


        //Act
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("SR1");
        $this->myOrderItem1->setAmount(1);
        $this->myOrderItem1->setOrderLinePrice(5);
        $this->myOrderItem1->setItemPrice(5);
        $this->myOrder->addItem($this->myOrderItem1);

        $this->myOrderItem2->setOrderRef($this->myOrder);
        $this->myOrderItem2->setProduct("GR1");
        $this->myOrderItem2->setAmount(1);
        $this->myOrderItem2->setOrderLinePrice(3.11);
        $this->myOrderItem2->setItemPrice(3.11);
        $this->myOrder->addItem($this->myOrderItem2);

        $this->myOrderItem3->setOrderRef($this->myOrder);
        $this->myOrderItem3->setProduct("CF1");
        $this->myOrderItem3->setAmount(3);
        $this->myOrderItem3->setOrderLinePrice(11.23);
        $this->myOrderItem3->setItemPrice(11.23);
        $this->myOrder->addItem($this->myOrderItem3);

        $this->myOrder->calculateItemsDiscount();

        //Assert
        $this->assertEquals($this->myOrder->totalPrice(), 30.57);

    }
}

?>

