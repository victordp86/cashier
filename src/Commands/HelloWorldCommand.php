<?php

// 01 giving a name space
//Remember to set MyExample in the autoload.psr-4 in composer.json

namespace MyExample\Commands;

// 02 Importing the Command base class
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\SetError;

// 03 Importing the input/output interfaces

require_once 'src/Entity/Order.php';
require_once 'src/Entity/OrderItem.php';

class HelloWorldCommand extends Command
{
    private $myOrder;
    private $myOrderItem1;
    private $myOrderItem2;
    private $myOrderItem3;

    // 05 Implementing the configure method
    protected function configure()
    {
        $this
            ->setName('buy')
            ->addArgument('name', InputArgument::OPTIONAL, 'Your name');
    }

    // 09 implementing the execute method
    protected function execute(InputInterface $input, OutputInterface $output): int
    { // 11 returning the success status
        $items = [];
        $keepAsking = true;
        while ($keepAsking) {
            $helper = $this->getHelper('question');
            $question = new ConfirmationQuestion('I want to add a new product to the cart?', false);

            $keepAsking = $helper->ask($input, $output, $question);
            $output->writeln('You have just selected: ' . $keepAsking);

            if ($keepAsking) {
                $helper = $this->getHelper('question');
                $question = new Question('Please enter de product code?', false);

                $productCode = $helper->ask($input, $output, $question);
                $output->writeln('You have just selected: ' . $productCode);

                $helper = $this->getHelper('question');
                $question = new Question('Please enter de product amount?', false);

                $productAmount = $helper->ask($input, $output, $question);
                $output->writeln('Selected amount: ' . $productAmount);

                $items[$productCode] = $productAmount + isset($items[$productCode]) ?? 0;

            }
        }

        $this->myOrder = new \App\Entity\Order();

        $this->myOrderItem1 = new \App\Entity\OrderItem();
        $this->myOrderItem2 = new \App\Entity\OrderItem();
        $this->myOrderItem3 = new \App\Entity\OrderItem();

        if (isset($items["SR1"])) {
            $this->myOrderItem1->setOrderRef($this->myOrder);
            $this->myOrderItem1->setProduct("SR1");
            $this->myOrderItem1->setAmount($items["SR1"]);
            $this->myOrderItem1->setOrderLinePrice(5);
            $this->myOrderItem1->setItemPrice(5);
            $this->myOrder->addItem($this->myOrderItem1);
        }


        if (isset($items["GR1"])) {
            $this->myOrderItem2->setOrderRef($this->myOrder);
            $this->myOrderItem2->setProduct("GR1");
            $this->myOrderItem2->setAmount($items["GR1"]);
            $this->myOrderItem2->setOrderLinePrice(3.11);
            $this->myOrderItem2->setItemPrice(3.11);
            $this->myOrder->addItem($this->myOrderItem2);
        }


        if (isset($items["CF1"])) {
            $this->myOrderItem3->setOrderRef($this->myOrder);
            $this->myOrderItem3->setProduct("CF1");
            $this->myOrderItem3->setAmount(3);
            $this->myOrderItem3->setOrderLinePrice(11.23);
            $this->myOrderItem3->setItemPrice(11.23);
            $this->myOrder->addItem($this->myOrderItem3);
        }


        $this->myOrder->calculateItemsDiscount();

        $output->writeln('Total price: ' . $this->myOrder->totalPrice());

        return Command::SUCCESS;
    }
}
