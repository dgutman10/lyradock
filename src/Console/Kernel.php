<?php


namespace Lyratool\Console;


use Exception;
use Illuminate\Container\Container;
use Lyratool\Console\Command\Docker\Compose\Down;
use Lyratool\Console\Command\Docker\Compose\Logs;
use Lyratool\Console\Command\Docker\Compose\Up;
use Lyratool\Console\Command\Update;
use Lyratool\Exception\KernelException;
use Symfony\Component\Console\Application as Console;

class Kernel
{
    /**
     * @var Console
     */
    private $console;

    private $commands = [
        #Console
        Update::class,
        # Docker Compose
        Up::class,
        Down::class,
        Logs::class
    ];
    /**
     * @var Container
     */
    private $app;

    /**
     * Kernel constructor.
     * @param Container $app
     * @param Console $console
     */
    public function __construct(Container $app, Console $console)
    {
        $this->console = $console;
        $this->app = $app;
        
        $this->console->setName("Lyracons Developer Tools");
        $this->console->setVersion("1.0.0");

        $this->registerCommands();
    }

    /**
     * @throws KernelException
     */
    public function run()
    {
        try {
            $this->console->run();
        } catch (Exception $exception) {
            throw new KernelException($exception->getMessage());
        }
    }

    public function registerCommands()
    {
        array_map(function ($command) {
            $this->console->add($this->app->make($command));
        },$this->commands);
    }
}
