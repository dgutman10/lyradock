<?php


namespace Lyratool\Console\Command;


use Lyratool\Exception\ExecException;
use Lyratool\Process\Exec;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Update extends Command
{
    /**
     * @var string the name of the command
     */
    protected static $defaultName = 'update';

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
        $this->setDescription('Actualiza a la última versión de la aplicación')
            ->setHelp('Actualiza a la última versión de la aplicación')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln("<info>Actualizando aplicación</info>");
            $result = $this->exec->run(["docker", "pull", "dgutman/lyradock"], null, null, null, null, true);
            $output->writeln($result);

            return Command::SUCCESS;
        } catch (ExecException $exception) {
            $output->writeln("<error>{$exception->getMessage()}</error>");

            return Command::FAILURE;
        }
    }
}
