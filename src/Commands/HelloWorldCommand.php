<?php

// 01 giving a name space
//Remember to set MyExample in the autoload.psr-4 in composer.json

namespace MyExample\Commands;

// 02 Importing the Command base class
use Symfony\Component\Console\Command\Command;
// 03 Importing the input/output interfaces
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// 04 Defining the class extending the Command base class
class HelloWorldCommand extends Command
{
    // 05 Implementing the configure method
    protected function configure()
    {
        $this
            // 06 defining the command name
            ->setName('hello')
            // 07 defining the description of the command
            ->setDescription('Prints Hello')
            // 08 defining the help (shown with -h option)
            ->setHelp('This command prints a simple greeting.');

        $this
            ->setDescription('Cast a random spell!')
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Your name')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'Yell?')
  ;
    }

    // 09 implementing the execute method
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourName = $input->getArgument('your-name');
         $helper = $this->getHelper('question');

        $io = new SymfonyStyle($input, $output);
        $io->ask('Product code?');
        // 10 using the Output for writing something
        $value = 0;
        $io->ask('Number of workers to start');
//        $io->ask('Number of workers to start', '1', function (string $number): int {
//            if (!is_numeric($number)) {
//                throw new \RuntimeException('You must type a number.');
//            }
//           $value = (int) $number;
//           return $value;
//        });


        $output->writeln("Hello, " . $io. "!");
        $output->writeln("Hello, " . get_current_user() . "!");
//        $output->writeln("It's " . date("l"));
        // 11 returning the success status
        return Command::SUCCESS;
    }
}
