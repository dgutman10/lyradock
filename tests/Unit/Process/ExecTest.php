<?php


namespace Test\Unit\Process;


use Lyratool\Process\Exec;
use Lyratool\Process\ProcessFactory;
use Symfony\Component\Process\Process;
use Test\TestCase;

class ExecTest extends TestCase
{
    /**
     * @test
     * @testdox should run a process successfully
     */
    public function caseOne()
    {
        $args = [['cat'], null, null, null, null];
        $processFactoryMock = \Mockery::mock(ProcessFactory::class);
        $processMock = \Mockery::mock(Process::class);
        $processFactoryMock->shouldReceive('make')
            ->withArgs($args)
            ->andReturn($processMock);
        $processMock->shouldReceive('run');
        $processMock->shouldReceive('getOutput')->andReturn("executed");

        $exec = new Exec($processFactoryMock);

        $this->assertSame("executed", $exec->run(['cat'], null, null, null, null));
    }
}