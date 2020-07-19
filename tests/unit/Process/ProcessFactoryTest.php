<?php


namespace unit\Process;


use PHPUnit\Framework\TestCase;
use Lyratool\Process\ProcessFactory;
use Symfony\Component\Process\Process;

class ProcessFactoryTest extends TestCase
{
    /**
     * @test
     * @testdox Should return symfony Process instance
     */
    public function caseOne()
    {
        $process = ProcessFactory::make(['ls'], null, null, null, 60);

        $this->assertInstanceOf(Process::class, $process);
    }

    /**
     * @test
     * @testdox $process->getCommandLine() should return expected command line
     */
    public function caseTwo()
    {
        $commandLine = "cat";
        $process = ProcessFactory::make([$commandLine], null, null, null, 60);

        $this->assertStringContainsString($commandLine, $process->getCommandLine());
    }

    /**
     * @test
     * @testdox $process->getWorkingDirectory() should return expected working directory
     */
    public function caseThree()
    {
        $commandLine = "cat";
        $cwd = "/home";
        $process = ProcessFactory::make([$commandLine], $cwd, null, null, 60);

        $this->assertStringContainsString($cwd, $process->getWorkingDirectory());
    }

    /**
     * @test
     * @testdox $process->getEnv() should return expected environments
     */
    public function caseFour()
    {
        $commandLine = "cat";
        $environments = ["FOO" => "BAR"];
        $process = ProcessFactory::make([$commandLine], null, $environments, null, 60);

        $this->assertSame($environments, $process->getEnv());
    }

    /**
     * @test
     * @testdox $process->getInput() should return expected input
     */
    public function caseFive()
    {
        $commandLine = "cat";
        $input = 'input-stream';
        $process = ProcessFactory::make([$commandLine], null, null, $input, 60);

        $this->assertSame($input, $process->getInput());
    }

    /**
     * @test
     * @testdox $process->getTimeout() should return expected timeout
     */
    public function caseSix()
    {
        $commandLine = "cat";
        $timeout = floatval(60);
        $process = ProcessFactory::make([$commandLine], null, null, null, $timeout);

        $this->assertSame($timeout, $process->getTimeout());
    }
}
