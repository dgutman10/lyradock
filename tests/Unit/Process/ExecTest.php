<?php


namespace Test\Unit\Process;


use Lyratool\Exception\ExecException;
use Lyratool\Process\Exec;
use Lyratool\Process\ProcessFactory;
use Mockery;
use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\Process;
use Test\TestCase;

class ExecTest extends TestCase
{
    /**
     * @test
     * @testdox should run a process successfully
     *
     * @throws ExecException
     */
    public function caseOne()
    {
        $args = [['cat'], null, null, null, null];
        $processFactoryMock = Mockery::mock(ProcessFactory::class);
        $processMock = Mockery::mock(Process::class);
        $processFactoryMock->shouldReceive('make')
            ->withArgs($args)
            ->andReturn($processMock);
        $processMock->shouldReceive('setTty')
            ->andReturn($processMock);
        $processMock->shouldReceive('run');
        $processMock->shouldReceive('getOutput')->andReturn("executed");

        $exec = new Exec($processFactoryMock);
        $processResult = $exec->run(['cat'], null, null, null, null, false);
        $this->assertSame("executed", $processResult);
    }

    /**
     * @test
     * @testdox should handle RuntimeException
     */
    public function caseTwo()
    {
        $processFactoryMock = Mockery::mock(ProcessFactory::class);
        $processMock = Mockery::mock(Process::class);
        $processFactoryMock->shouldReceive('make')
            ->andReturn($processMock);
        $processMock->shouldReceive('setTty')
            ->andReturn($processMock);
        $processMock->shouldReceive('run')
            ->andThrow(RuntimeException::class);
        $this->expectException(ExecException::class);

        $exec = new Exec($processFactoryMock);
        $exec->run(['cat'], null, null, null, null, false);
    }
}
