<?php

namespace ChrisHalbert\PhpBCC\Console;

use ChrisHalbert\PhpBCC\Exceptions\InvalidArgumentException;
use ChrisHalbert\PhpBCC\Input\CloverInput;
use ChrisHalbert\PhpBCC\Output\AuthorOutput;
use ChrisHalbert\PhpBCC\Output\TextOutput;
use ChrisHalbert\PhpBCC\VCS\GitVCS;
use Symfony\Component\Console\Input\InputInterface as SymfonyInput;
use Symfony\Component\Console\Output\OutputInterface as SymfonyOutput;


class CommandTest extends \PHPUnit_Framework_TestCase
{
    protected $command;

    protected $reflection;

    protected $output;

    protected $input;

    public function setUp()
    {
        $this->command = new Command();
        $this->reflection = new \ReflectionClass(Command::class);

        $this->output = $this->getMockBuilder(SymfonyOutput::class)
            ->setMethods(get_class_methods(SymfonyOutput::class))
            ->getMock();

        $this->input = $this->getMockBuilder(SymfonyInput::class)
            ->setMethods(get_class_methods(SymfonyInput::class))
            ->getMock();
    }

    /**
     * @dataProvider dataProviderTestLoadInputFormat
     */
    public function testLoadInputFormat($option, $instance = null, $exception = null)
    {
        if ($exception) {
            $this->setExpectedException($exception);
        }

        $this->input->expects($this->any())
            ->method('getArgument')
            ->with('path')
            ->willReturn(dirname(__FILE__) . '/../../resources/clover-input.xml');

        $this->input->expects($this->any())
            ->method('getOption')
            ->with('input-format')
            ->willReturn($option);

        $actual = $this->runMethod('loadInputFormat', [$this->input]);

        $this->assertInstanceOf($instance, $actual);
    }

    public function dataProviderTestLoadInputFormat()
    {
        return [
            ['clover', CloverInput::class, null],
            ['fake', null, InvalidArgumentException::class]
        ];
    }


    /**
     * @dataProvider dataProviderTestLoadVCSType
     */
    public function testLoadVCSType($option, $instance = null, $exception = null)
    {
        if ($exception) {
            $this->setExpectedException($exception);
        }

        $this->input->expects($this->any())
            ->method('getOption')
            ->with('vcs')
            ->willReturn($option);

        $actual = $this->runMethod('loadVCSType', [$this->input]);

        $this->assertInstanceOf($instance, $actual);
    }

    public function dataProviderTestLoadVCSType()
    {
        return [
            ['git', GitVCS::class, null],
            ['fake', null, InvalidArgumentException::class]
        ];
    }

    /**
     * @dataProvider dataProviderTestLoadOutputFormat
     */
    public function testLoadOutputFormat($option, $instance = null, $exception = null)
    {
        if ($exception) {
            $this->setExpectedException($exception);
        }

        $this->input->expects($this->any())
            ->method('getOption')
            ->with('output-format')
            ->willReturn($option);

        $actual = $this->runMethod('loadOutputFormat', [$this->input]);

        $this->assertInstanceOf($instance, $actual);
    }

    public function dataProviderTestLoadOutputFormat()
    {
        return [
            ['text', TextOutput::class, null],
            ['author', AuthorOutput::class, null],
            ['fake', null, InvalidArgumentException::class]
        ];
    }

    protected function runMethod($methodName, array $args = [])
    {
        $method = $this->reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($this->command, $args);
    }
}
