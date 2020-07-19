<?php


namespace Lyratool\Process;


class Exec
{
    /**
     * @var ProcessFactory
     */
    private $processFactory;

    public function __construct(ProcessFactory $processFactory)
    {
        $this->processFactory = $processFactory;
    }

    /**
     * @param array          $command The command to run and its arguments listed as separate entries
     * @param string|null    $cwd     The working directory or null to use the working dir of the current PHP process
     * @param array|null     $env     The environment variables or null to use the same environment as the current PHP process
     * @param mixed|null     $input   The input as stream resource, scalar or \Traversable, or null for no input
     * @param int|float|null $timeout The timeout in seconds or null to disable
     */
    public function run(array $command, ?string $cwd, ?array $env, $input, $timeout)
    {
        $process = $this->processFactory->make($command, $cwd, $env, $input, $timeout);

        $process->run();

        return $process->getOutput();
    }
}