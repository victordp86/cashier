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

        $this->myOrderItem1= new \App\Entity\OrderItem();
        $this->myOrderItem1->setOrderRef($this->myOrder);
        $this->myOrderItem1->setProduct("GR1");

//        $this->myOrderItem2->setOrderRef($this->myOrder);
//        $this->myOrderItem2->setProduct("SR1");

    }

    public function tearDown(): void
    {
        // Clean up any resources used during testing
    }

    public function testProductIsAddedToOrder()
    {

        $this->myOrder->addItem($this->myOrderItem1);
        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');
//        $this->myOrder->getStatus();
//         fwrite(STDERR, print_r($this->myOrder->getStatus(), TRUE));
//        var_dump($this->myOrder->getStatus());
//          $this->myOrder->addItem($this->myOrderItem1);
//        $result = $this->myClass->concatenateStrings('hello', 'world');
//
//        $this->assertEquals('helloworld', $result);
    }
//    public function testTwoProductsAreAddedToOrder()
//    {
//
//        $this->myOrder->addItem($this->myOrderItem1);
//        $this->assertEquals($this->myOrder->getItems()[0]->getProduct(), 'GR1');
//        $this->myOrder->addItem($this->myOrderItem1);
//        $this->assertEquals($this->myOrder->getItems()[1]->getProduct(), 'GR1');
////        $this->myOrder->getStatus();
////         fwrite(STDERR, print_r($this->myOrder->getStatus(), TRUE));
////        var_dump($this->myOrder->getStatus());
////          $this->myOrder->addItem($this->myOrderItem1);
////        $result = $this->myClass->concatenateStrings('hello', 'world');
////
////        $this->assertEquals('helloworld', $result);
//    }
}
?>

