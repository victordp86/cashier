<?php

use PHPUnit\Framework\TestCase;

require_once 'src/Entity/Order.php';
require_once 'src/Entity/OrderItem.php';

class MyClassTest extends TestCase
{
    private $myOrder;
    private $myOrderItem1;
    private $myOrderItem2;

    public function setUp(): void
    {
        $this->myOrder= new \App\Entity\Order();



    }

    public function tearDown(): void
    {
        // Clean up any resources used during testing
//       $this->myOrder->removeItem($this->myOrderItem1);
//       $this->myOrder->removeItem($this->myOrderItem2);
    }

    public function testProductIsAddedToOrder()
    {

        //Arrange
        $this->myOrderItem1= new \App\Entity\OrderItem();

        //Act
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("GR1");
        $this->myOrder->addItem($this->myOrderItem1);

        //Assert
        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');
//        $this->myOrder->getStatus();
//         fwrite(STDERR, print_r($this->myOrder->getStatus(), TRUE));
//        var_dump($this->myOrder->getStatus());
//          $this->myOrder->addItem($this->myOrderItem1);
//        $result = $this->myClass->concatenateStrings('hello', 'world');
//
//        $this->assertEquals('helloworld', $result);

        $this->myOrder->removeItem($this->myOrderItem1);
    }
    public function testTwoProductsAreAddedToOrder()
    {
//
        //Arrange
        $this->myOrderItem1= new \App\Entity\OrderItem();
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("GR1");
        //Act
        $this->myOrder->addItem($this->myOrderItem1);

        //Assert
        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');


        $this->myOrderItem2 = new \App\Entity\OrderItem();
        $this->myOrderItem2->setOrderRef($this->myOrder);
        $this->myOrderItem2->setProduct("SR1");
        $this->myOrder->addItem($this->myOrderItem2);
        $this->assertEquals($this->myOrder->getItems()[1]->getProduct(), 'SR1');


//        $this->myOrder->addItem($this->myOrderItem1);
//        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');
//
//        $this->myOrder->addItem($this->myOrderItem2);
//        $this->myOrderItem2->setProduct("SR1");
//        $this->myOrder->addItem($this->myOrderItem2);
//        $this->assertEquals($this->myOrder->getItems()[1]->getProduct(), 'GR1');
////        $this->myOrder->getStatus();
////         fwrite(STDERR, print_r($this->myOrder->getStatus(), TRUE));
////        var_dump($this->myOrder->getStatus());
////          $this->myOrder->addItem($this->myOrderItem1);
////        $result = $this->myClass->concatenateStrings('hello', 'world');
////
////        $this->assertEquals('helloworld', $result);
    }
    public function testThreeProductsAreAddedToOrder()
    {
//
        //Arrange
        $this->myOrderItem1= new \App\Entity\OrderItem();
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("GR1");
        //Act
        $this->myOrder->addItem($this->myOrderItem1);

        //Assert
        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');


        $this->myOrderItem2 = new \App\Entity\OrderItem();
        $this->myOrderItem2->setOrderRef($this->myOrder);
        $this->myOrderItem2->setProduct("SR1");
        $this->myOrder->addItem($this->myOrderItem2);
        $this->assertEquals($this->myOrder->getItems()[1]->getProduct(), 'SR1');

        $this->myOrderItem3 = new \App\Entity\OrderItem();
        $this->myOrderItem3->setOrderRef($this->myOrder);
        $this->myOrderItem3->setProduct("CF1");
        $this->myOrder->addItem($this->myOrderItem3);
        $this->assertEquals($this->myOrder->getItems()[2]->getProduct(), 'CF1');


//        $this->myOrder->addItem($this->myOrderItem1);
//        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');
//
//        $this->myOrder->addItem($this->myOrderItem2);
//        $this->myOrderItem2->setProduct("SR1");
//        $this->myOrder->addItem($this->myOrderItem2);
//        $this->assertEquals($this->myOrder->getItems()[1]->getProduct(), 'GR1');
////        $this->myOrder->getStatus();
////         fwrite(STDERR, print_r($this->myOrder->getStatus(), TRUE));
////        var_dump($this->myOrder->getStatus());
////          $this->myOrder->addItem($this->myOrderItem1);
////        $result = $this->myClass->concatenateStrings('hello', 'world');
////
////        $this->assertEquals('helloworld', $result);
    }

    public function testWhenAddedTwoGreanTeasWeHaveOneFree()
    {

        //Arrange
        $this->myOrderItem1= new \App\Entity\OrderItem();

        //Act
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("GR1");
        $this->myOrderItem1->setAmount(2);
        $this->myOrder->addItem($this->myOrderItem1);

        //Assert
        $this->assertEquals($this->myOrder->calculateItemsDiscount(), true);
//        $this->myOrder->getStatus();
//         fwrite(STDERR, print_r($this->myOrder->getStatus(), TRUE));
//        var_dump($this->myOrder->getStatus());
//          $this->myOrder->addItem($this->myOrderItem1);
//        $result = $this->myClass->concatenateStrings('hello', 'world');
//
//        $this->assertEquals('helloworld', $result);

        $this->myOrder->removeItem($this->myOrderItem1);
    }
}
?>

