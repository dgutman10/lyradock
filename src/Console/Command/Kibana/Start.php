<?php


namespace Lyratool\Console\Command\Kibana;


use Lyratool\Exception\ExecException;
use Lyratool\Process\Exec;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Start extends Command
{
    /**
     * @var string the name of the command
     */
    protected static $defaultName = 'kibana:start';

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
        $this->setDescription('Monitoreo de logs')
            ->setHelp('Monitorea el log de todos los containers corriendo en docker')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln("<info>Iniciando kibana</info>");
            $result = $this->exec->run(["docker-compose", "up", "-d"], "/app/compose/kibana", null, null, null, true);
            $output->writeln($result);
            $output->writeln("<comment>Kibana estará listo en unos segundos en la siguiente ruta</comment>");
            $output->writeln("<href=http://localhost:5601>http://localhost:5601</>\n");

            return Command::SUCCESS;
        } catch (ExecException $exception) {
            $output->writeln("<error>{$exception->getMessage()}</error>");

            return Command::FAILURE;
        }
    }
}
