<?php


namespace Lyratool\Console\Command\Docker\Compose;


use Lyratool\Exception\ExecException;
use Lyratool\Process\Exec;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Ps extends Command
{
    /**
     * @var string the name of the command
     */
    protected static $defaultName = 'docker-compose:ps';

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
        $this->setDescription('Lista los contenedores corriendo de compose')
            ->setAliases(['ps'])
            ->setHelp('Debe correrse dentro de la carpeta de un proyecto')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln("<info>Obteniendo información de los contenedores...</info>");
            $cwdParts = explode( '/', getenv('CWD'));
            $cwd = end($cwdParts);
            $result = $this->exec->run(["docker-compose", "ps"], "/app/compose/{$cwd}", null, null, null, true);
            $output->writeln($result);

            return Command::SUCCESS;
        } catch (ExecException $exception) {
            $output->writeln("<error>{$exception->getMessage()}</error>");

            return Command::FAILURE;
        }
    }
}
