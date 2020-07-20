<?php


namespace Lyratool\Console\Command;


use Lyratool\Process\Exec;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Down extends Command
{
    /**
     * @var string the name of the command (the part after "bin/console")
     */
    protected static $defaultName = 'down';

    /**
     * @var Exec
     */
    private $exec;

    public function __construct(Exec $exec, string $name = null)
    {
        $this->exec = $exec;
        
        parent::__construct($name);
    }

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
        $output->writeln("Deteniedo contenedores");

        $cwdParts = explode( '/', getenv('CWD'));
        $cwd = end($cwdParts);

        $result = $this->exec->run(["docker-compose", "down"], "/app/compose/{$cwd}", null, null, 60, true);

        $output->writeln($result);


        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}