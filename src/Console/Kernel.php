<?php


namespace Lyratool\Console;


use Exception;
use Lyratool\Console\Command\Start;
use Lyratool\Exception\KernelException;
use Symfony\Component\Console\Application as Console;

class Kernel
{
    /**
     * @var Console
     */
    private $console;

    private $commands = [
        Start::class
    ];

    /**
     * Kernel constructor.
     * @param Console $console
     * @throws KernelException
     */
    public function __construct(Console $console)
    {
        $this->console = $console;
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
            $this->console->add(new $command());
        },$this->commands);
    }
}