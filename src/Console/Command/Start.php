<?php


namespace Lyratool\Console\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Start extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'start';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('start project')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Start project in context')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("starting project");
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}