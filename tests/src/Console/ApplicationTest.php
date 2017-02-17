<?php

namespace ChrisHalbert\PhpBCC\Console;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    protected $application;

    public function setUp()
    {
        $this->application = $this->getMockBuilder(Application::class)
            ->setMethods(['parentDoRun'])
            ->getMock();
    }

    public function testGetCommandName()
    {
        $inputMock = $this->getMockBuilder(InputInterface::class)
            ->setMethods(get_class_methods(InputInterface::class))
            ->getMock();

        $reflectingApplication = new \ReflectionClass(Application::class);
        $getCommandName = $reflectingApplication->getMethod('getCommandName');
        $getCommandName->setAccessible(true);

        $actual = $getCommandName->invokeArgs($this->application, [$inputMock]);
        $this->assertEquals('phpbcc', $actual);
    }

    public function testDefaultCommands()
    {
        $commands = $this->application->all();
        $this->assertArrayHasKey('phpbcc', $commands);
    }

    public function testGetDefinition()
    {
        $definition = $this->application->getDefinition();
        $this->assertEmpty($definition->getArguments());
    }

    public function testDoRun()
    {
        $outputMock = $this->getMockBuilder(OutputInterface::class)
            ->setMethods(get_class_methods(OutputInterface::class))
            ->getMock();

        $outputMock->expects($this->once())
            ->method('write')
            ->with('phpbcc version 1.0.0 by Chris Halbert' . PHP_EOL . PHP_EOL);

        $inputMock = $this->getMockBuilder(InputInterface::class)
            ->setMethods(get_class_methods(InputInterface::class))
            ->getMock();

        $this->application->doRun($inputMock, $outputMock);
    }
}
